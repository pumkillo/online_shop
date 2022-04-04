<?php
class Router
{
    private static $routes = [
        'main' => 'index.php',
        'login' => 'login.php',
        'logout' => 'logout.php',
        'signup' => 'signup.php',
    ];

    public static function redirect($route, $time=0)
    {
        sleep($time);
        header('Location: ' . self::$routes[$route]);
    }
}
