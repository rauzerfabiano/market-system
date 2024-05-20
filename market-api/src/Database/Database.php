<?php

namespace App\Database;

use PDO;
use Dotenv\Dotenv;
use PDOException;

class Database {
    private static $conn = null;

    public static function getConnection() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    
        if (self::$conn === null) {
            try {
                $dsn = "pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";";
                self::$conn = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Print or log the error message
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}    
