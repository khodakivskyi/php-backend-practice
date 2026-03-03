<?php

namespace classes;

use PDOException;

class Service
{
    private readonly Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function addUser($login, $password): bool
    {
        try{
            if (empty($login) || strlen($login) < 3 || !preg_match('/^[a-zA-Z0-9_]+$/', $login)) return false;

            if (empty($password) || strlen($password) < 6) return false;

            $existedUser = $this->db->getUserByLogin($login);
            if ($existedUser) return false;

            $this->db->addUser($login, $password);
            return true;
        } catch (Exception){
            return false;
        }
    }
}