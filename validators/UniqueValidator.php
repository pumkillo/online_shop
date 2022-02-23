<?php
require_once(Loader::load('db'));
class PasswordValidator
{
    public static $messages = '';

    public static function validate($table, $field, $data)
    {
        $query = "SELECT * FROM" . $table . "WHERE " . $field . " = '" . $data . "'";
        $res = mysqli_query($mysqli, $query);
        return empty($res) ? true : false;
    }
}
