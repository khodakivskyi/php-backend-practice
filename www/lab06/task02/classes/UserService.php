<?php

namespace classes;

class UserService {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function register(string $name, string $email, string $password): array|string {
        $name = trim($name);
        $email = trim($email);
        $password = trim($password);

        if ($name === '' || $email === '' || $password === '') return "All fields are required";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Invalid email format";
        if (strlen($password) < 6) return "Password must be at least 6 characters";

        try {
            if ($this->getByEmail($email)) return "Invalid data";

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO users2 (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed
            ]);

            return [
                'id' => $this->pdo->lastInsertId(),
                'name' => $name,
                'email' => $email
            ];
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function login(string $email, string $password): array|string {
        $user = $this->getByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) return "Invalid data";
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }

    public function update(int $id, string $name, string $email, string $password): bool|string {
        $user = $this->getById($id);
        if (!$user || !password_verify($password, $user['password'])) return "Invalid data";

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE users2 SET name = :name, email = :email, password = :password WHERE id = :id");
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed
        ]);

        return $stmt->rowCount() > 0;
    }

    public function delete(string $email, string $password): bool|string {
        $user = $this->getByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) return "Invalid data";

        $stmt = $this->pdo->prepare("DELETE FROM users2 WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->rowCount() > 0;
    }

    public function getAll(): array|string {
        try {
            $stmt = $this->pdo->query("SELECT * FROM users2");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    private function getByEmail(string $email): array|false|string {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users2 WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    private function getById(int $id): array|false|string {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users2 WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}