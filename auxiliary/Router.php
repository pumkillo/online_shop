<?php
class Router
{
    private static $routes = [
        'main' => 'index.php',
        'login' => 'login.php',
        'logout' => 'logout.php',
        'signup' => 'signup.php',
        'add_to_cart' => 'add_to_cart.php',
        'cart' => 'cart.php',
        'user_orders' => 'user_orders.php',
        'create_order' => 'create_order.php',
        'add_item' => 'add_item.php',
        'delete_item' => 'delete_item.php',
        'edit_item'=> 'edit_item.php',
        'delete_order' => 'delete_order.php',
        'all_orders' => 'all_orders.php',
        'delete_cart_item' => 'delete_cart_item.php',
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
