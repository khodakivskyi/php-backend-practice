<?php
$allowedActions = ['register', 'users', 'login', 'update', 'delete'];
$pdo = dbConnect();

if (isset($_GET['action']) && in_array($_GET['action'], $allowedActions)) {
    $data = json_decode(file_get_contents("php://input"), true);

    switch ($_GET['action']) {
        case $allowedActions[0]:
            $result = register(
                $data['name'],
                $data['email'],
                $data['password'],
                $pdo
            );
            echo json_encode($result);
            exit;

        case $allowedActions[1]:
            $result = getAllUsers($pdo);
            echo json_encode($result);
            exit;

        case $allowedActions[2]:
            $result = login(
                $data['email'],
                $data['password'],
                $pdo
            );
            echo json_encode($result);
            exit;

        case $allowedActions[3]:
            $result = updateUser(
                $data['id'],
                $data['name'],
                $data['email'],
                $data['password'],
                $pdo
            );
            echo json_encode($result);
            exit;

        case $allowedActions[4]:
            $result = deleteUser(
                $data['email'],
                $data['password'],
                $pdo
            );
            echo json_encode($result);
            exit;
    }
} else {
    return "Incorrect action";
}

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

function register($name, $email, $password, $pdo) {
    if (!$pdo) {
        return "Database connection error";
    }
    $name = trim($name);
    $email = trim($email);
    $password = trim($password);

    if ($name === '' || $email === '' || $password === '') {
        return "All fields are required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }

    if (strlen($password) < 6) {
        return "Password must be at least 6 characters";
    }

    try {
        $existingUser = getUserByEmail($email, $pdo);
        if ($existingUser) {
            return "Invalid data";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        return [
            'id' => $pdo->lastInsertId(),
            'name' => $name,
            'email' => $email
        ];

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getUserByEmail($email, $pdo) {
    try {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getUserById($id, $pdo) {
    try {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getAllUsers($pdo) {
    try {
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function login($email, $password, $pdo) {
    try {
        $existingUser = getUserByEmail($email, $pdo);

        if ($existingUser === null || !password_verify($password, $existingUser->password)) return "Invalid data";
        return [
            'id' => $existingUser['id'],
            'name' => $existingUser['name'],
            'email' => $existingUser['email']
        ];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function updateUser($id, $name, $email, $password, $pdo) {
    try {
        $existingUser = getUserById($id, $pdo);
        if ($existingUser === null || !password_verify($password, $existingUser->password)) return "Invalid data";

        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function deleteUser($email, $password, $pdo) {
    try {
        $existingUser = getUserByEmail($email, $pdo);

        if ($existingUser === null || !password_verify($password, $existingUser->password)) return "Invalid data";

        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
