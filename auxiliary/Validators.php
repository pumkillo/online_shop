<?php
class Validators
{
    private array $validators = [
        'required' => 'RequiredValidator',
        'unique' => 'UniqueValidator',
        'password' => 'PasswordValidator',
        'russian' => 'RussianValidator',
        'min_max' => 'MinMaxValidator',
        'email' => 'EmailValidator',
    ];

    private array $errors = [];
    private array $fields = [];
    private array $rules = [];

    public function __construct(array $fields, array $rules)
    {
        $this->fields = $fields;
        $this->rules = $rules;
        $this->validate();
    }

    private function validate(): void
    {
        foreach ($this->rules as $fieldName => $fieldValidators) {
            $this->validateField($fieldName, $fieldValidators);
        }
    }

    private function validateField(string $fieldName, array $fieldValidators): void
    {
        //Перебираем все валидаторы, ассоциированные с полем
        foreach ($fieldValidators as $validatorName) {
            //Отделяем от имени валидатора дополнительные аргументы
            $tmp = explode(':', $validatorName);
            [$validatorName, $args] = count($tmp) > 1 ? $tmp : [$validatorName, null];
            $args = isset($args) ? explode(',', $args) : [];

            //Соотносим имя валидатора с классом в массиве разрешенных валидаторов
            $validatorClass = $this->validators[$validatorName];
            if (!isset($this->validators[$validatorName])) {
                continue;
            }
            //Создаем объект валидатора, передаем туда параметры
            require_once(__DIR__ . '/../validators/' . $validatorClass . '.php');
            $validator = new $validatorClass(
                $fieldName,
                $this->fields[$fieldName],
                $args
            );

            if (!$validator->rule()) {
                $this->errors[$fieldName][] = $validator->validate();
            }
        }
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function fails(): bool
    {
        return (bool)count($this->errors);
    }
}
