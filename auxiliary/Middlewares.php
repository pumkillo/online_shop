<?php
class Middlewares
{
    private static $middlewares = [
        'auth' => '',
        'admin' => '',
    ];
    
    public static function go(string $key): string
    {
        return static::$middlewares[strtolower($key)] ?? '';
    }
}
