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
        if (Query::table('orders')->insert([
            'user_id' => $_SESSION['id'],
            'time' => date('Y-m-d H:i:s'),
        ])) {
            // Router::redirect('cart');
            echo "ok";
            
        } else {
            echo date('Y-m-d H:i:s');
            // Thursday 7th of April 2022 08:52:21 PM
            renderError("Ошибка оформления заказа");
        }
        ?>
    </div>
</body>

</html>