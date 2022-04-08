<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
AuthMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('views', 'errors'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once(Loader::load('views') . 'head.php');
    ?>
    <title>Главная</title>
</head>


<body>
    <div class="container">
        <?php
        require_once(Loader::load('views') . 'header.php');
        $cartItems = Query::table('cart_items')->where("user_id LIKE '" . $_SESSION['id'] . "'");
        foreach ($cartItems as $cartItem) :
            $item = Query::table('items')->where("id LIKE '" . $cartItem['item_id'] . "'")[0];
        ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?? 'У этого товара нет наименования' ?></h5>
                    <p class="card-text"><?= $item['description'] ?? 'Нет описания' ?></p>
                    <p class="card-text"><?= $item['price'] . '&#x20bd;' ?? 'Цена не указана' ?></p>
                    <a href="<?= Router::get('delete_cart_item') . "?id=" . $cartItem['id'] ?>" class="btn btn-danger">Удалить из корзины</a>
                </div>
            </div>
        <?php endforeach;
        if (count($cartItems) !== 0) : ?>
            <a class="btn btn-primary" href="<?= Router::get('create_order') ?>">Оформить заказа</a>
        <?php else : ?>
            <p>Корзина пуста</p>
        <?php endif; ?>
    </div>
</body>

</html>