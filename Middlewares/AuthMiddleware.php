<?php
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('router'));
require_once(__DIR__.'/Interface.php');

class AuthMiddleware implements MiddlewareInterface
{
    public static function check(): void
    {
        if (!static::is()) {
            Router::redirect('login');
        }
    }

    public static function is(): bool
    {
        if (isset($_SESSION['id'])) {
            return true;
        }
        return false;
    }
}
