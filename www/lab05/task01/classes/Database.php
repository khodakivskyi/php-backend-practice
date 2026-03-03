<?php

namespace classes;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db = 'lab5';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }
    }

    public function getUserByLogin(string $login) {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE login = ?");
        $query->execute([$login]);
        return $query->fetch();
    }
    public function addUser(string $login, string $password): void {
        $query = $this->pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
        $query->execute([$login, $password]);
    }
}