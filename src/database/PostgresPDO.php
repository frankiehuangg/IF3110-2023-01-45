<?php

class PostgresPDO {
    private $pdo;

    private function __construct()
    {
        $host = 'localhost';
        $port = $_ENV['POSTGRES_PORT'];
        $username = $_ENV['POSTGRES_USERNAME'];
        $password = $_ENV['POSTGRES_PASSWORD'];
        $db = $_ENV['POSTGRES_DB'];

        try {
            $this->pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db;", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}