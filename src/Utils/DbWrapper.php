<?php

namespace Utils;

use PDO;
use PDOException;

class DbWrapper{

    private static $conn;

    public static function getConnection(){
        if(self::$conn == null){
            self::$conn = self::getPdo();
        }

        return self::$conn;
    }

    private static function getPdo()
    {
        $host = "gasskull.ru:3306";
        $db = "auto_service";
        $charset = "utf8";
        $user = "root";
        $pass = "root";

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $pdo = new PDO($dsn, $user, $pass, $opt);
            return $pdo;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}