<?php

class Database {
    private static string $dbinit = 'mysql:host=localhost; dbname=supermarket_database';
    private static string $username = 'ng';
    private static string $password = 'eh98gyfh8971gf';
    private static PDO $db;

    private function __construct() {}

    public static function get_db(): PDO {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    self::$dbinit,
                    self::$username,
                    self::$password
                );
            } catch (PDOException $e) {
                $error = $e -> getMessage();
                echo dirname(__DIR__) . '/errors/database_error.php';
                include dirname(__DIR__) . '/errors/database_error.php';
                exit;
            }
        }

        return self::$db;
    }
}