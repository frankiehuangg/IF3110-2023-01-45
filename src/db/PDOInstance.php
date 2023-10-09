<?php

class PDOInstance {
    private static $instance;
    private $pdo;

    private function __construct() {
        $DB_HOST     = $_ENV['POSTGRES_HOST'] ? $_ENV['POSTGRES_HOST'] : 'tubes-db';
        $DB_PORT     = $_ENV['POSTGRES_PORT'];
        $DB_USERNAME = $_ENV['POSTGRES_USER'];
        $DB_PASSWORD = $_ENV['POSTGRES_PASSWORD'];
        $DB_NAME     = $_ENV['POSTGRES_DB'];

        try {
            $URI = "pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
            $this->pdo = new PDO($URI, $DB_USERNAME, $DB_PASSWORD);
        } catch (PDOException $e) {
            die('Error: Could not connect to ' . $e . '.');
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDOInstance();
        }

        return self::$instance;
    }

    public function __destruct() {
        $this->pdo = null;
    }

    public function getPDO() {
        return $this->pdo;
    }
}

?>
