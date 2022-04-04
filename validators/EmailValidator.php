<?php
require_once(__DIR__ . '/AbstractValidator.php');

class EmailValidator extends AbstractValidator
{
    public function rule(): bool
    {
        return (bool)filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }

    public function message(): string
    {
        return 'Поле должно соответствовать шаблону электронной почты.';
    }
}
