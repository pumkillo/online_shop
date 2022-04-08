<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
AuthMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('query'));
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
        foreach (Query::table('cart_items')->where("user_id LIKE '" . $_SESSION['id'] . "'") as $cartItem) :
            $item = Query::table('items')->where("id LIKE '" . $cartItem['item_id'] . "'")[0];
        ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?? 'У этого товара нет наименования' ?></h5>
                    <p class="card-text"><?= $item['description'] ?? 'Нет описания' ?></p>
                    <p class="card-text"><?= $item['price'] . '&#x20bd;' ?? 'Цена не указана' ?></p>
                    <a href="<?= Router::get('delete_cart_item') . "?id=" . $item['id'] ?>" class="btn btn-danger">Удалить из корзины</a>
                </div>
            </div>
        <?php endforeach; ?>
        <a class="btn btn-primary" href="<?= Router::get('create_order') ?>">Оформить заказа</a>
    </div>
</body>

</html>