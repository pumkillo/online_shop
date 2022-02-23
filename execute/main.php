<?php
session_start();
// Подключение настроек приложения
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('app'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="../assets/static/css/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
</head>

<body>
    <!-- <script src="../assets/static/js/ajax.js" defer></script> -->
    <?php

    if (!isset($_SESSION['id'])) :
    ?>
        <a href="<?= EXECUTED ?>login.php">Войти</a>
        <a href="<?= EXECUTED ?>signup.php">Зарегистрироваться</a>
    <?php else : ?>
        <a href="<?= EXECUTED ?>logout.php">Выйти</a>
    <?php endif; ?>
</body>

</html>