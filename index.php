<?php
// Подключение настроек приложения
require_once(__DIR__ . '/auxiliary/Loader.php');
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
        foreach (Query::table('items')->all() as $item) : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['name'] ?? '' ?></h5>
                    <p class="card-text"><?= $item['description'] ?? '' ?></p>
                    <p class="card-text"><?= $item['price'] ?? '' ?></p>
                    <a href="<?= Router::get('add_to_cart') ?>" class="btn btn-primary">Добавить в корзину</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>