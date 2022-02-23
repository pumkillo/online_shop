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


    <form method="post">
        <input type="text" name="name" placeholder="Фамилия">
        <input type="text" name="surname" placeholder="Имя">
        <input type="text" name="last_name" placeholder="Отчество">
        <input type="text" name="email" placeholder="Ваш email">
        <input type="text" name="password" placeholder="Придумайте пароль">
        <input type="text" name="password_again" placeholder="Повторите пароль">
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>

<?php
if (!empty($_POST['submit']) && $_POST['submit'] == 'Регистрация') {
    // Очищаем пришедшие данные от HTML и PHP тегов
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);

    // Проверяем, есть ли пользователь с таким логином
    $query = "SELECT * FROM user WHERE Login = '$login'";
    $res = mysqli_query($mysqli, $query);

    if ($res->{'num_rows'} != 0) {
        echo "<h2>Такой пользователь уже существует</h2>";
    } else {
        // Если пользователя нет, то добавляем его в базу данных и перенаправляем на главную страницу
        $query = "INSERT INTO user (login, password) VALUES ('$login','$password')";
        $res = mysqli_query($mysqli, $query);
        if (!$res) die(mysqli_error($mysqli));

        header('Location: ../index.html');
    }
}
?>

</html>