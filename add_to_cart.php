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
    <title>Добавление товара в корзину</title>
    <?php require_once(Loader::load('views') . 'head.php'); ?>
</head>

<body>
    <div class="container">
        <?php require_once(Loader::load('views') . 'header.php');
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            renderError('Отсутствует обязательный параметр (id)');
            exit();
        }
        if (Query::table('cart_items')->insert([
            'user_id' => $_SESSION['id'],
            'item_id' => $id,
        ])) {
            Router::redirect('main');
        } else {
            renderError("Ошибка добавления товара в корзину");
        }
        ?>
    </div>
</body>

</html>