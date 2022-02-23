<?php
    session_start();
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
    if (isset($_SESSION['id'])) :
        unset($_SESSION['id']);
        header('Location: main.php');
    else : ?>
        <p>Чтобы выйти, Вы должны быть авторизированы.</p>
    <?php endif; ?>
</body>

</html>