<?php
session_start();
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('db'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../assets/static/css/style.css">
</head>

<body>
    <?php

    if (!isset($_SESSION['id'])) :
    ?>
        <a href="<?= EXECUTED ?>login.php">Войти</a>
        <a href="<?= EXECUTED ?>signup.php">Зарегистрироваться</a>
    <?php else : ?>
        <a href="<?= EXECUTED ?>logout.php">Выйти</a>
    <?php endif;

    if (isset($_SESSION['id'])) : ?>
        <p>Вы уже вошли в систему.</p>
    <?php else : ?>
        <form method="post">
            <input type="text" name="email" placeholder="Введите Ваш email">
            <input type="password" name="password" placeholder="Введите Ваш пароль">
            <input type="submit" value="Войти">
        </form>
    <?php endif;

    if (!empty($_POST)) {
        // Очищаем пришедшие данные от HTML и PHP тегов
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $password = md5($password);

        // Создаём запрос на пользователя с введёнными данными
        $query = "SELECT * FROM users WHERE email LIKE '$email' and password LIKE '$password'";
        $res = mysqli_query($mysqli, $query);
        if (!$res) die(mysqli_error($mysqli));
        $row = mysqli_fetch_assoc($res);

        // Если есть пользователь с такими данными, то записываем их в сессию
        // и перенаправляем пользователя на главную страницу, иначе выдаём ошибку
        if (gettype($row) !== 'NULL' && $row['email'] === $email && $row['password'] === $password) {
            $_SESSION['id'] = $row['id'];
            header('Location: main.php');
        } else {
            echo "<h2>Введены некорректные данные!</h2>";
        }
    }
    ?>
</body>