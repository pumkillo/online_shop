<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
AdminMiddleware::check();

require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('router'));
require_once(Loader::load('validators'));
require_once(Loader::load('views', 'errors'));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <?php require_once(Loader::load('views', 'head')); ?>
    <title>Добавление товара</title>
</head>


<body>
    <div class="container">
        <?php
        $errors = [];
        if (!empty($_POST)) {
            $validator = new Validators($_POST, [
                'name' => ['required'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $isSuccess = Query::table('items')->insert([
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'name' => $_POST['name'],
                ]);
                if ($isSuccess) {
                    Router::redirect('main');
                }
            }
        }
        require_once(Loader::load('views') . 'header.php');
        ?>
        <form method="post" class="container" style="max-width: 500px;">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Наименование товара" class="form-control" value="<?= $_POST['name'] ?? '' ?>">
                <?php Errors::renderErrors($errors, 'name'); ?>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Описание товара"><?= $_POST['description'] ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <input type="number" name="price" class="form-control" value="<?= $_POST['price'] ?? 0 ?>">
                <?php if (isset($isSuccess) && !$isSuccess) {
                    Errors::renderError('Ошибка добавления товара в Базу Данных');
                } ?>
            </div>
            <input type="submit" value="Добавить" class="btn btn-primary">
        </form>
    </div>

</body>