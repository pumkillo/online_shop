<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
AdminMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('router'));
require_once(Loader::load('query'));
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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            renderError('Отсутствует обязательный параметр (id)');
            exit();
        }
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