<?php

$page = $_GET['page'] ?? 'login';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($page === 'register') {

    }

    if($page === 'login') {}

    header("Location: index.php");
    exit;
}

switch ($page) {
    case 'register':
        include './views/registrationForm.php';
        break;

    default:
        include './views/loginForm.php';
        break;
}
