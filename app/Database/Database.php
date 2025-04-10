<?php

namespace App\Database;

use \PDO;
class Database
{
    private static $instance;
    private $connection;
    public function __construct()
    {
        $this->connection = $this->createConnection();
    }

    public function createConnection()
    {
        $host = $_ENV['DB_HOST'];
        $db   = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $port = $_ENV['DB_PORT'];
        $pass = $_ENV['DB_PASSWORD'];
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch(\PDOException $e) {
             die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($sql, $params = [], $getOne = false){
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        if($getOne){
            return $stmt->fetch();
        }
        return $stmt->fetchAll();
    }
}