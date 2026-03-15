<?php

function dbConnect() {
    try {
        $pdo = new PDO(
            'mysql:host=db;dbname=lab6;charset=utf8mb4',
            'root',
            'rootpass'
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}