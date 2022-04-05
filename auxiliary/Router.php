<?php
class Router
{
    private static $routes = [
        'main' => 'index.php',
        'login' => 'login.php',
        'logout' => 'logout.php',
        'signup' => 'signup.php',
        'add_to_cart' => 'add_to_cart.php',
    ];

    public static function redirect(string $route, int $time = 0): void
    {
        sleep($time);
        header('Location: ' . self::$routes[$route]);
    }

    public static function get(string $key): string
    {
        return static::$routes[$key] ?? '#';
    }
}
