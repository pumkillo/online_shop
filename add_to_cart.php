<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Loader::load('router'));
require_once(Middlewares::getClass('auth'));
// Router::redirect('main');
AuthMiddleware::check();
?>
