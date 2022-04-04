<?php
class Loader
{
    private static $set = [
        'db' => __DIR__ . '/../config/db_connect.php',
        'app' => __DIR__ . '/../config/app_config.php',
        'views' => __DIR__ . '/../views/',
        'query' => __DIR__ . '/Query.php',
        'router' => __DIR__ . '/Router.php',
    ];

    public static function load($key): string
    {
        return self::$set[$key];
    }
}
