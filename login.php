<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('validators'));
require_once(Loader::load('router'));
require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('auth'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once(Loader::load('views') . 'head.php');
    ?>
    <title>Авторизация</title>
</head>


<body>
    <div class="container">
        <?php
        if (!empty($_POST)) {
            $password = md5($_POST['password']);
            $res = Query::table('users')->where("email LIKE '" . $_POST['email'] . "' AND password LIKE '$password'");

            if (isset($res[0]) && $res[0]['email'] === $_POST['email'] && $res[0]['password'] === $password) {
                $_SESSION['id'] = $res[0]['id'];
                Router::redirect('main');
            } else {
                $message = "Введены некорректные данные!";
            }
        }
        require_once(Loader::load('views') . 'header.php');
        if (!AuthMiddleware::is()) :
        ?>
            <div class="container">
                <form method="post" class="container" style="max-width: 500px;">
                    <div class="mb-3">
                        <input type="text" name="email" placeholder="Введите Ваш email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" placeholder="Введите Ваш пароль" class="form-control">
                    </div>

                    <p class="errors text-danger"><?= $message ?? '' ?></p>
                    <input type="submit" value="Войти" class="btn btn-primary">
                </form>
            <?php else : ?>
                <p>Вы уже вошли в систему.</p>
            <?php endif; ?>
            </div>
    </div>

</body>