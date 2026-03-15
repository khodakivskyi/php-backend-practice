<?php

namespace classes;

readonly class Service
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function addUser(UserService $user): ?UserService
    {
        try {
            if (empty($user->login) || strlen($user->login) < 4) return null;
            if (empty($user->password) || strlen($user->password) < 4) return null;

            $existedUser = $this->db->getUserByLogin($user->login);
            if ($existedUser) return null;

            return $this->db->addUser($user);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getUserByLogin(string $login, string $password): ?UserService
    {
        try {
            $user = $this->db->getUserByLogin($login);
            if ($user === null || !password_verify($password, $user->password)) return null;

            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getUserById(int $id): ?UserService
    {
        try {
            return $this->db->getUserById($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function updateUser(UserService $user): ?UserService
    {
        try {
            $existingUser = $this->db->getUserById($user->id);
            if (!$existingUser) return null;

            return $this->db->updateUser($user);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function deleteUser(UserService $user): bool
    {
        try {
            return $this->db->deleteUser($user);
        } catch (\Exception $e) {
            return false;
        }
    }
}