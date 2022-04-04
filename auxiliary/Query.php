<?php
require_once(__DIR__ . '/../auxiliary/Loader.php');
require_once(Loader::load('db'));

class Query
{
    use dbConnection {
        connect as private;
    }
    private string $table = '';
    private $mysqli = 'db_connection';

    function __construct(string $tablename)
    {
        $this->table = $tablename;
        $this->mysqli = $this->connect();
    }

    public static function table(string $tablename)
    {
        return new Query($tablename);
    }

    public function where(string $condition): array
    {
        return $this->mysqli->query("SELECT *  FROM " . $this->table . " WHERE " . $condition)->fetch_all($mode = MYSQLI_ASSOC);
    }

    public function all(): array
    {
        return $this->mysqli->query('SELECT * FROM ' . $this->table)->fetch_all($mode = MYSQLI_ASSOC);
    }

    public function insert(array $data, $columns = '', $values = ''): bool
    {
        foreach ($data as $key => $value) {
            $columns = $columns  . $key . ", ";
            $values = $values . "'" . $value . "', ";
        }
        $columns = substr($columns, 0, -2);
        $values = substr($values, 0, -2);
        return (bool)$this->mysqli->query("INSERT INTO " . $this->table . " (" . $columns . ") VALUES (" . $values . ")");
    }
}
