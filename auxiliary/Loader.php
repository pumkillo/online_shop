<?php
class Loader
{
    private static $set = [
        'db' => __DIR__ . '/../config/db_connect.php',
        'app' => __DIR__ . '/../config/app_config.php',
        'unique' => __DIR__ . '/../validators/UniqueValidator.php',
        'fio' => __DIR__ . '/../validators/FIOValidator.php',
        'email' => __DIR__ . '/../validators/EmailValidator.php',
        'password' => __DIR__ . '/../validators/PasswordValidator.php',
        'queries' => __DIR__ . '/Queries.php',
    ];

    public static function load($key)
    {
        return self::$set[$key];
    }
}
