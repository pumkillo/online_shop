<?php
require_once('../auxiliary/Loader.php');
require_once(Loader::load('query'));
require_once(Loader::load('router'));

class AdminMiddleware
{
    public static function check(): void
    {
        if (!isset($_SESSION['id'])) {
            Router::redirect('login');
        }
        var_dump(Query::table('users')->where("id LIKE '" . $_SESSION['id'] . "'"));
    }
}
