<ul class="nav justify-content-end">
    <?php
    if (!isset($_SESSION['id'])) :
    ?>
        <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>login.php">Войти</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>signup.php">Зарегистрироваться</a></li>
    <?php else : ?>
        <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>logout.php">Выйти</a></li>
    <?php endif; ?>
</ul>