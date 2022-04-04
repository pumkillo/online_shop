<?php
trait dbConnection
{
    public function connect()
    {
        //Подключение к БД
        $mysqli = new mysqli('localhost', 'root', '', 'online_shop');
        if (mysqli_connect_errno()) {
            echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
            return;
        }
        return $mysqli;
    }
}
