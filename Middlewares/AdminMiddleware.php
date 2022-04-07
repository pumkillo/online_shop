<?php
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('query'));
require_once(Loader::load('router'));

class AdminMiddleware 
{
    private static $errorMessage = 'У Вас нет доступа к этой странице.';

    public static function check(): void
    {
        if (!isset($_SESSION['id'])) {
            Router::redirect('login');
        }
        if (!static::is()) {
            echo static::$errorMessage;
            Router::redirect('main', 3);
        }
    }

    public static function is(): bool
    {
        if (isset($_SESSION['id']) && Query::table('users')->where("id LIKE '" . $_SESSION['id'] . "'")[0]['is_admin'] == 1) {
            return true;
        }
        return false;
    }
}
