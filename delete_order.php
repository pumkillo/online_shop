<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('router'));
require_once(Loader::load('query'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
require_once(Middlewares::getClass('owner'));
require_once(Loader::load('views', 'errors'));
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Удаление заказа</title>
    <?php require_once(Loader::load('views') . 'head.php'); ?>
</head>

<body>
    <div class="container">
        <?php require_once(Loader::load('views') . 'header.php');
        AdminMiddleware::check();
        OwnerMiddleware::check();
        $id = $_GET['id'] ?? -1;
        $condition = "id LIKE '$id'";
        if (count(Query::table('orders')->where($condition)) === 0) {
            renderError('Такого заказа не существует.');
            exit();
        }
        if (Query::table('orders')->delete($condition)) {
            Router::redirect('main');
        } else {
            renderError("Ошибка удаления заказа.");
        }
        ?>
    </div>
</body>

</html>