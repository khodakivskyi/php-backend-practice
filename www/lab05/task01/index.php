<?php

include_once("./classes/User.php");
include_once("./classes/Service.php");
include_once("./classes/Database.php");

use classes\UserService;
use classes\Database;
use classes\Service;

session_start();

$db = new Database();
$service = new Service($db);

$page = $_GET['page'] ?? 'login';

$loggedInUser = $_SESSION['User'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'register') {
        $user = new UserService([
            'login' => $_POST['login'] ?? '',
            'password' => $_POST['password'] ?? '',
            'email' => $_POST['email'] ?? '',
            'name' => $_POST['name'] ?? null,
            'surname' => $_POST['surname'] ?? null,
            'birth_date' => $_POST['birth_date'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'address' => $_POST['address'] ?? null,
            'avatar_url' => $_POST['avatar_url'] ?? null,
        ]);

        $createdUser = $service->addUser($user);

        if ($createdUser) {
            $_SESSION['User'] = $createdUser;
            $_SESSION['success'] = "User successfully registered. Welcome, " . htmlspecialchars($createdUser->login);
        } else {
            $_SESSION['error'] = "Registration failed. Check your input or user already exists.";
        }

        header("Location: index.php");
        exit;
    }

    if($page === 'login') {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $service->getUserByLogin($login, $password);

        if ($user) {
            $_SESSION['User'] = $user;
        } else {
            $_SESSION['error'] = "Login failed. Check your username or password.";
        }

        header("Location: index.php");
        exit;
    }

    if($page === 'logout') {
        unset($_SESSION['User']);
        unset($_SESSION['success']);
        header("Location: index.php");
        exit;
    }


}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'logout':
        unset($_SESSION['User']);
        unset($_SESSION['success']);
        header("Location: index.php");
        exit;

    case 'delete':
        if ($loggedInUser) {
            $result = $service->deleteUser($loggedInUser);
            if ($result) {
                unset($_SESSION['User']);
                $_SESSION['success'] = "Account deleted successfully!";
            } else {
                $_SESSION['error'] = "Failed to delete account.";
            }
        }
        header("Location: index.php");
        exit;
}

if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}

if ($loggedInUser) {
    echo "<h2>Welcome, " . htmlspecialchars($loggedInUser->login) . "!</h2>";
    echo '<p><a href="?action=logout">Log out</a></p>';
    echo '<p><a href="profile.php">Edit profile</a></p>';
    echo '<p><a href="?action=delete">Delete account</a></p>';
} else {
    switch ($page) {
        case 'register':
            include './views/registrationForm.php';
            break;
        default:
            include './views/loginForm.php';
            break;
    }
}
