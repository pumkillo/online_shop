<?php
require_once(Loader::load('db'));
class PasswordValidator
{
    public static $messages = '';

    public static function validate($data)
    {
        return (bool)preg_match('/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S{6,25}$/', $data);
    }
}
