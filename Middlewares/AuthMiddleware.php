<?php
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('router'));

class AuthMiddleware
{
    public static function check(): void
    {
        if (!isset($_SESSION['id'])) {
            Router::redirect('login');
        }
    }
}
