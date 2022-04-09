<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
AuthMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('router'));
require_once(Loader::load('query'));
require_once(Loader::load('views', 'errors'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Оформление заказа</title>
    <?php require_once(Loader::load('views') . 'head.php'); ?>
</head>

<body>
    <div class="container">
        <?php require_once(Loader::load('views') . 'header.php');
        $orderSQL = Query::table('orders');
        $orderSQL->insert([
            'user_id' => $_SESSION['id'],
            'time' => date('Y-m-d H:i:s'),
        ]);
        $lastOrderId =  $orderSQL->lastId();
        // $lastOrderId =  "6";
        if ($lastOrderId !== 0) {
            $cartItems = Query::table('cart_items')->where("user_id LIKE '" . $_SESSION['id'] . "'");
            foreach ($cartItems as $cartItem) {
                $item = Query::table('items')->where("id LIKE " . $cartItem['item_id'])[0];
                if (
                    !Query::table('order_items')->insert([
                        'order_id' => $lastOrderId,
                        'item_id' => $cartItem['item_id'],
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                    ]) ||
                    !Query::table('orders')->update([
                        'price' => "price + " . $item['price'],
                    ], "id LIKE $lastOrderId")
                ) {
                    Errors::renderError("Ошибка оформления заказа");
                    exit();
                }
            }
            Query::table('cart_items')->delete("user_id LIKE " . $_SESSION['id']);
            Router::redirect('cart');
        }
        ?>
    </div>
</body>

</html>