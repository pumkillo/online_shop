<?php
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('router'));

?>
<div class="header d-flex justify-content-between">
    <a class="nav-link" href="<?= ROOT ?><?= Router::get('main')?>">Главная</a>
    <ul class="nav justify-content-end">
        <?php
        if (!isset($_SESSION['id'])) :
        ?>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('login') ?>">Войти</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('signup') ?>">Зарегистрироваться</a></li>
        <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('logout') ?>">Выйти</a></li>
        <?php endif; ?>
    </ul>
</div>