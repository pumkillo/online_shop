<?php

require_once(__DIR__ . '/db_config.php');

//Подключение к БД
$mysqli = mysqli_connect($host, $user, $password, $database);

//Отображение ошибки при неудачном подключении к БД
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
}