<?php

namespace classes;

class User
{
    public ?int $id;
    public string $login;
    public string $password;
    public string $email;
    public ?string $name;
    public ?string $surname;
    public ?string $birth_date;
    public ?string $phone;
    public ?string $address;
    public ?string $avatar_url;
    public ?string $user_role;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->login = $data['login'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->name = $data['name'] ?? null;
        $this->surname = $data['surname'] ?? null;
        $this->birth_date = $data['birth_date'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->avatar_url = $data['avatar_url'] ?? null;
        $this->user_role = $data['user_role'] ?? 'user';
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }
}