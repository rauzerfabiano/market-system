<?php

class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            $dsn = "pgsql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";";
            self::$conn = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
