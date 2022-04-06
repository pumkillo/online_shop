<?php
require_once(__DIR__ . '/auxiliary/Loader.php');
require_once(Loader::load('app'));
require_once(Loader::load('query'));
require_once(Loader::load('router'));
require_once(Loader::load('validators'));
require_once(Loader::load('middlewares'));
require_once(Middlewares::getClass('admin'));
require_once(Loader::load('views', 'errors'));
AdminMiddleware::check();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once(Loader::load('views', 'head'));
    ?>
    <title>Редактирование данных о товаре</title>
</head>


<body>
    <div class="container">
        <?php
        $errors = [];
        $prev_data = Query::table('items')->where("id LIKE '" . $_GET['id'] . "'")[0];
        if (!empty($_POST)) {

            $validator = new Validators($_POST, [
                'name' => ['required'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                Query::table('items')->update([
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'name' => $_POST['name'],
                ], "id LIKE " . $_GET['id']);
            }
        }
        require_once(Loader::load('views') . 'header.php');
        ?>
        <form method="post" class="container" style="max-width: 500px;">
            <div class="mb-3">
                <input type="text" name="name" placeholder="Наименование товара" class="form-control" value="<?= $prev_data['name'] ?? '' ?>">
                <?php renderErrors($errors, 'name'); ?>
            </div>

            <div class="mb-3">
                <textarea class="form-control" name="description" placeholder="Описание товара"><?= $prev_data['description'] ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <input type="number" name="price" class="form-control" value="<?= $prev_data['price'] ?? '' ?>">
            </div>
            <input type="submit" value="Обновить" class="btn btn-primary">
        </form>
    </div>

</body>