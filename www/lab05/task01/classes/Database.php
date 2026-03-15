<?php

namespace classes;

use PDO;
use PDOException;
use classes\UserService;

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = 'db';
        $db = 'lab5';
        $user = 'root';
        $pass = 'rootpass';
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

    public function getUserByLogin(string $login): ?UserService
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);
        $data = $stmt->fetch();

        if (!$data) return null;

        return new UserService($data);
    }

    public function getUserById(int $id): ?UserService
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (!$data) return null;
        return new UserService($data);
    }

    public function addUser(UserService $user): ?UserService
    {
        $hash = password_hash($user->password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("
        INSERT INTO users 
        (login, password, email, name, surname, birth_date, phone, address, avatar_url, user_role, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
        $stmt->execute([
            $user->login,
            $hash,
            $user->email,
            $user->name,
            $user->surname,
            $user->birth_date,
            $user->phone,
            $user->address,
            $user->avatar_url,
            $user->user_role ?? 'user'
        ]);

        $id = $this->pdo->lastInsertId();

        return $this->getUserById($id);
    }

    public function updateUser(UserService $user): ?UserService
    {
        $stmt = $this->pdo->prepare("
        UPDATE users 
        SET login = ?, email = ?, name = ?, surname = ?, birth_date = ?, phone = ?, address = ?, avatar_url = ?, updated_at = NOW() 
        WHERE id = ?
    ");
        $stmt->execute([
            $user->login,
            $user->email,
            $user->name,
            $user->surname,
            $user->birth_date,
            $user->phone,
            $user->address,
            $user->avatar_url,
            $user->id
        ]);

        return $this->getUserById($user->id);
    }

    public function deleteUser(UserService $user): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$user->id]);
        } catch (\Exception $e) {
            return false;
        }
    }
}