<?php
require_once(Loader::load('router'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
require_once(Middlewares::getClass('admin'));

?>
<div class="header d-flex justify-content-between">
    <a class="nav-link" href="<?= ROOT ?><?= Router::get('main') ?>">Главная</a>
    <ul class="nav justify-content-end">
        <?php
        if (!AuthMiddleware::is()) :
        ?>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('login') ?>">Войти</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('signup') ?>">Зарегистрироваться</a></li>
        <?php else : ?>
            <?php if (AdminMiddleware::is()) : ?>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('add_item') ?>">+Товар</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('all_orders') ?>">Все заказы</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('cart') ?>">Корзина</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= ROOT ?><?= Router::get('user_orders') ?>">Мои заказы</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="<?= ROOT ?><?= Router::get('logout') ?>">Выйти</a></li>
        <?php endif; ?>
    </ul>
</div>