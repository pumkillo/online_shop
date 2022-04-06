<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('router'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Выход</title>
    <?php
    require_once(Loader::load('views') . 'head.php');
    ?>
</head>

<body>
    <div class="container">
        <?php
        require_once(Loader::load('views') . 'header.php');
        if (!AuthMiddleware::is()) :
        ?>
            <p>Чтобы выйти, Вы должны быть авторизированы.</p>
        <?php else :
            unset($_SESSION['id']);
            Router::redirect('main');
        endif;
        ?>
    </div>
</body>

</html>