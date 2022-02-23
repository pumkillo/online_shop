<?php
require_once(Loader::load('db'));
class PasswordValidator
{
    public static $messages = '';

    public static function validate($data)
    {
        return (bool)filter_var($data, FILTER_VALIDATE_EMAIL);
    }
}
