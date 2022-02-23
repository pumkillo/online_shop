<?php
require_once(Loader::load('db'));
class PasswordValidator
{
    public static $messages = '';

    public static function validate($data, $min, $max)
    {
        return (bool)preg_match('/^[а-я\s]{' . $min . ',' . $max . '}$/ui', $data);
    }
}
