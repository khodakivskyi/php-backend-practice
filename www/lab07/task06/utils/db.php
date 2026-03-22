<?php

function dbConnect() {
    $host = 'db';
    $db   = 'lab07';
    $user = 'root';
    $pass = 'rootpass';

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8mb4",
            $user,
            $pass
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        die("DB Error: " . $e->getMessage());
    }
}