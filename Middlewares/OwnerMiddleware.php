<?php
// require_once(__DIR__ . '/../auxiliary/Loader.php');
// require_once(Loader::load('query'));
// require_once(Loader::load('router'));

// class OwnerMiddleware
// {
//     private static $errorMessage = 'Чтобы выполнить это действие, Вы должны быть создателем этой записи';
//     private static $tableName = '';
//     private static $column = '';
//     private static $userId = -1;
//     private static $recordId = '';

//     public static function check(int $userId = $_SESSION['id'], string $tableName, string $recordId, string $column = 'user_id'): void
//     {
//         static::$tableName = $tableName;
//         static::$userId = $userId;
//         static::$recordId = $recordId;
//         static::$column = $column;
//         if (!isset($_SESSION['id'])) {
//             Router::redirect('login');
//         }
//         if (!static::is()) {
//             echo static::$errorMessage;
//             Router::redirect('main', 3);
//         }
//     }

//     private static function is(): bool
//     {
//         if (isset($_SESSION['id']) && Query::table(static::$tableName)->where(static::$column." LIKE '" . static::$recordId . "'")[0][] == ) {
//             return true;
//         }
//         return false;
//     }
// }


// IN PROCCESS...