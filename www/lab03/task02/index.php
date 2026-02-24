<?php
session_start();

if (isset($_GET["logout"])) {
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
}

$fontSize = $_COOKIE['fontSize'] ?? 'medium';
$correctLogin = 'admin';
$correctPassword = 'pass';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if ($login === $correctLogin && $password === $correctPassword) {
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;
        include("templates/info.php");
        exit;
    } else {
        include("templates/fail.php");
        exit;
    }
}

if (isset($_SESSION["login"]) || isset($_SESSION["password"])) {
    include("templates/info.php");
} else {
    include("templates/login.php");
}