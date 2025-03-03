<?php

namespace App;

use Exception;
use PDO;

class Database
{
    private $host = '127.0.0.1';
    private $dbname = 'vitrine-retail';
    private $user = 'root';
    private $pass = '123#Mudar';
    private $pdo;

    public function connect()
    {
        if (!$this->pdo) {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}