<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('router'));
require_once(Loader::load('query'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
require_once(Loader::load('views', 'errors'));
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Удаление товара</title>
    <?php require_once(Loader::load('views') . 'head.php'); ?>
</head>

<body>
    <div class="container">
        <?php require_once(Loader::load('views') . 'header.php');
        AdminMiddleware::check();
        $id = $_GET['id'] ?? -1;
        $condition = "id LIKE '$id'";
        if (count(Query::table('items')->where($condition)) === 0) {
            renderError('Такой записи не существует.');
            exit();
        }
        if (Query::table('items')->delete($condition)) {
            Router::redirect('main');
        } else {
            renderError("Ошибка удаления товара");
        }
        ?>
    </div>
</body>

</html>