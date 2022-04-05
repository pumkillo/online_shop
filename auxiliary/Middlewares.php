<?php
class Middlewares
{
    private static $middlewares = [
        'auth' => 'AuthMiddleware',
        'admin' => 'AdminMiddleware',
    ];

    public static function getClass(string $key): string
    {
        return __DIR__ . '/../Middlewares/' . static::$middlewares[strtolower($key)]. '.php';
    }
}
