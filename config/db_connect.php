<?php
trait dbConnection
{
    public function connect()
    {
        //Подключение к БД
        require_once(__DIR__ . '/db_config.php');
        $mysqli = new mysqli('localhost', 'root', '', 'online_shop');
        // $mysqli = new mysqli(strval($host), $user, $password, $database);
        if (mysqli_connect_errno()) {
            echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
            return;
        }
        return $mysqli;
    }
}
