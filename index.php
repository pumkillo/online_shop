<?php
// Подключение настроек приложения
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
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
        foreach (Query::table('items')->all() as $item) : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?? 'У этого товара нет наименования' ?></h5>
                    <p class="card-text"><?= $item['description'] ?? 'Нет описания' ?></p>
                    <p class="card-text"><?= $item['price'] . '&#x20bd;' ?? 'Цена не указана' ?></p>
                    <a href="<?= Router::get('add_to_cart') . "?id=" . $item['id'] ?>" class="btn btn-primary">Добавить в корзину</a>
                    <?php
                    if (AdminMiddleware::is()) :
                    ?>
                        <a href="<?= Router::get('edit_item') . "?id=" . $item['id'] ?>" class="btn btn-secondary">Изменить</a>
                        <a href="<?= Router::get('delete_item') . "?id=" . $item['id'] ?>" class="btn btn-danger">Удалить</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>