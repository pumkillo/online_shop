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
    <?php endif; ?>

    <?php

    if (!empty($_POST)) {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        $name = strip_tags($_POST['name']);
        $surname = strip_tags($_POST['surname']);
        $patronymic = strip_tags($_POST['patronymic']);

        // Проверяем, есть ли пользователь с таким логином вынести в валидатор
        $query = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($mysqli, $query);


        if ($res->{'num_rows'} != 0) {
            echo "<h2>Такой пользователь уже существует</h2>";
        } else {
            // Если пользователя нет, то добавляем его в базу данных и перенаправляем на главную страницу
            $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            $res = mysqli_query($mysqli, $query);
            if (!$res) die(mysqli_error($mysqli));
//            header('Location: ../index.html');
        }
    }
    ?>

    <form method="post">
        <input type="text" name="name" placeholder="Фамилия">
        <input type="text" name="surname" placeholder="Имя">
        <input type="text" name="patronymic" placeholder="Отчество">
        <input type="text" name="email" placeholder="Ваш email">
        <input type="text" name="password" placeholder="Придумайте пароль">
        <input type="text" name="password_again" placeholder="Повторите пароль">
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>



</html>