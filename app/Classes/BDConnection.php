<?php

class BDConnection {

    private static ?BDConnection $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $config = require_once 'config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
        $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
    }

    public static function getInstance(): BDConnection
    {
        if (!self::$instance) {
            self::$instance = new BDConnection();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

}