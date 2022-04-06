<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('router'));
require_once(Loader::load('validators'));
require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('views') . 'errors.php');
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
    <div class="container">
        <?php
        $errors = [];
        if (!empty($_POST)) {

            $validator = new Validators($_POST, [
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min_max:,6,30',],
                'name' => ['required', 'min_max:,2,20', 'russian'],
                'surname' => ['required', 'min_max:,2,20', 'russian'],
                'patronymic' => ['required', 'min_max:,6,40', 'russian'],
            ]);
            $check_passwords_error = ($_POST['password'] !== $_POST['password_again']) ? 'Введенные пароли не совпадают.' : '';

            if ($validator->fails() || $check_passwords_error !== '') {
                $errors = $validator->errors();
                $errors['password_again'] = [];
                array_push($errors['password_again'], $check_passwords_error);
            } else {
                Query::table('users')->insert([
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'name' => $_POST['name'],
                    'surname' => $_POST['surname'],
                    'patronymic' => $_POST['patronymic'],
                    'is_admin' => false,
                ]);
                Router::redirect('main');
            }
        }
        require_once(Loader::load('views') . 'header.php');
        ?>

        <form method="post" style="max-width: 500px;" class="container">

            <div class="mb-3">
                <input type="text" name="name" placeholder="Имя" class="form-control" value="<?= $_POST['name'] ?? '' ?>">
                <?php renderErrors($errors, 'name'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="surname" placeholder="Фамилия" class="form-control" value="<?= $_POST['surname'] ?? '' ?>">
                <?php renderErrors($errors, 'surname'); ?>
            </div>

            <div class="mb-3">
                <input type="text" name="patronymic" placeholder="Отчество" class="form-control" value="<?= $_POST['patronymic'] ?? '' ?>">
                <?php renderErrors($errors, 'patronymic'); ?>
            </div>

            <div class="mb-3">
                <input type="email" name="email" placeholder="Ваш email" class="form-control" value="<?= $_POST['email'] ?? '' ?>">
                <?php renderErrors($errors, 'email') ?>
            </div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Придумайте пароль" class="form-control">
                <?php renderErrors($errors, 'password'); ?>
            </div>

            <div class="mb-3">
                <input type="password" name="password_again" placeholder="Повторите пароль" class="form-control">
                <?php renderErrors($errors, 'password_again'); ?>
            </div>
            <?= $message ?? '' ?>
            <input type="submit" value="Зарегистрироваться" class="btn btn-primary">
        </form>
    </div>
</body>



</html>