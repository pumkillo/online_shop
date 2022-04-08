<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
AdminMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('query'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once(Loader::load('views') . 'head.php');
    ?>
    <title>Все заказы</title>
</head>


<body>
    <div class="container">
        <?php
        require_once(Loader::load('views') . 'header.php');
        foreach (Query::table('orders')->all() as $order) :
            $user  = Query::table('users')->where("id LIKE '" . $order['user_id'] . "'");
            $user = (isset($user[0]['name'])) ? "Заказчик: " . $user[0]['name'] : "Заказчик не указан";
        ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= 'Заказ №' . $order['id'] ?? '' ?></h5>
                    <p class="card-text"><?= $user ?></p>
                    <p class="card-text"><?= 'Общая сумма заказа: ' . $order['price'] . '&#x20bd;' ?? 'Цена не указана' ?></p>
                    <a href="<?= Router::get('delete_order') . "?id=" . $order['id'] ?>" class="btn btn-danger">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>