<?php
session_start();
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(__DIR__ . '/auxiliary/Validators.php');
require_once(Loader::load('router'));
require_once(Loader::load('app'));
require_once(Loader::load('query'));
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Регистрация</title>
    <?php
    require_once(Loader::load('views') . 'head.php');
    ?>
</head>


<body>
    <?php
    $errors = [];
    if (!empty($_POST)) {
        array_map(fn ($value) => strip_tags($value), $_POST);

        $validator = new Validators($_POST, [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min_max:,6,30',],
            'name' => ['required', 'min_max:,2,20', 'russian'],
            'surname' => ['required', 'min_max:,2,20', 'russian'],
            'patronymic' => ['required', 'min_max:,6,', 'russian'],
        ]);
        // $res = Query::table('users')->where("email LIKE '" . $_POST['email'] . "'");
        // $unique_error = (count($res)) ? 'Пользователь с таким email уже существует.' : '';
        $check_passwords_error = ($_POST['password'] !== $_POST['password_again']) ? 'Введенные пароли не совпадают.' : '';

        if ($validator->fails() || $check_passwords_error !== '' || $unique_error !== '') {
            $errors = $validator->errors();
            $errors['password_again'] = [];
            // $errors['email'] = $errors['email'] ?? [];
            // array_push($errors['email'], $unique_error);
            array_push($errors['password_again'], $check_passwords_error);
        } else {
            $res = Query::table('users')->insert([
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'patronymic' => $_POST['patronymic'],
                'is_admin' => 0,

            ]);
            // if (!$res) die(mysqli_error($mysqli));
            Router::redirect('main');
        }
    }
    require_once(Loader::load('views') . 'header.php');
    ?>

    <form method="post" style="max-width: 500px;" class="container">

        <div class="mb-3">
            <input type="text" name="name" placeholder="Фамилия" class="form-control">
            <?php
            if (isset($errors['name'])) {
                foreach ($errors['name'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <div class="mb-3">
            <input type="text" name="surname" placeholder="Имя" class="form-control">
            <?php
            if (isset($errors['surname'])) {
                foreach ($errors['surname'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <div class="mb-3">
            <input type="text" name="patronymic" placeholder="Отчество" class="form-control">
            <?php
            if (isset($errors['patronymic'])) {
                foreach ($errors['patronymic'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <div class="mb-3">
            <input type="email" name="email" placeholder="Ваш email" class="form-control">
            <?php
            if (isset($errors['email'])) {
                foreach ($errors['email'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <div class="mb-3">
            <input type="password" name="password" placeholder="Придумайте пароль" class="form-control">
            <?php
            if (isset($errors['password'])) {
                foreach ($errors['password'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <div class="mb-3">
            <input type="password" name="password_again" placeholder="Повторите пароль" class="form-control">
            <?php
            if (isset($errors['password_again'])) {
                foreach ($errors['password_again'] as $val) {
                    echo '<p class="text-danger">' . $val . '</p>';
                }
            }
            ?>
        </div>

        <?= $message ?? '' ?>
        <input type="submit" value="Зарегистрироваться" class="btn btn-primary">
    </form>
</body>



</html>