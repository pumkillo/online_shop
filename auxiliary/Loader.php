<?php
class Loader
{
    private static $set = [
        'db' => __DIR__ . '/../config/db_connect.php',
        'app' => __DIR__ . '/../config/app_config.php',
        'validators_unique' => __DIR__ . '/../validators/UniqueValidator.php',
        'validators_fio' => __DIR__ . '/../validators/FIOValidator.php',
        'validators_email' => __DIR__ . '/../validators/EmailValidator.php',
        'validators_password' => __DIR__ . '/../validators/PasswordValidator.php',
        'validators_queries' => __DIR__ . '/Queries.php',
    ];

    public static function load($key)
    {
        return self::$set[$key];
    }
}
