<?php

namespace classes;

class NoteService {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(int $userId, string $title, string $content): array|string {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notes (user_id, title, content) VALUES (:user_id, :title, :content)"
        );
        try {
            $stmt->execute([
                ':user_id' => $userId,
                ':title' => trim($title),
                ':content' => trim($content)
            ]);
            return [
                'id' => (int)$this->pdo->lastInsertId(),
                'user_id' => $userId,
                'title' => $title,
                'content' => $content
            ];
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getAll(int $userId): array {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, user_id, title, content, created_at, updated_at 
                 FROM notes WHERE user_id = :user_id ORDER BY created_at DESC"
            );
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById(int $noteId, int $userId): array|bool {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT id, user_id, title, content, created_at, updated_at 
                 FROM notes WHERE id = :id AND user_id = :user_id"
            );
            $stmt->execute([
                ':id' => $noteId,
                ':user_id' => $userId
            ]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function update(int $noteId, int $userId, string $title, string $content): bool|string {
        $stmt = $this->pdo->prepare(
            "UPDATE notes SET title = :title, content = :content, updated_at = CURRENT_TIMESTAMP
             WHERE id = :id AND user_id = :user_id"
        );
        try {
            $stmt->execute([
                ':id' => $noteId,
                ':user_id' => $userId,
                ':title' => trim($title),
                ':content' => trim($content)
            ]);
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete(int $noteId, int $userId): bool|string {
        $stmt = $this->pdo->prepare(
            "DELETE FROM notes WHERE id = :id AND user_id = :user_id"
        );
        try {
            $stmt->execute([
                ':id' => $noteId,
                ':user_id' => $userId
            ]);
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}