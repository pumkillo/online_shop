<?php
session_start();
class Loader
{
    private static $set = [
        'db' => __DIR__ . '/../config/db_connect.php',
        'app' => __DIR__ . '/../config/app_config.php',
        'views' => __DIR__ . '/../Views/',
        'query' => __DIR__ . '/Query.php',
        'validators' => __DIR__ . '/Validators.php',
        'router' => __DIR__ . '/Router.php',
        'middlewares' => __DIR__ . '/Middlewares.php',
    ];

    public static function load(string $key): string
    {
        return self::$set[strtolower($key)];
    }
}
