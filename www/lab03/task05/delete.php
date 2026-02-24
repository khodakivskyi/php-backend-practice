<?php
session_start();

function deleteDir($dir) {
    if (!is_dir($dir)) return;
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') continue;
        $path = $dir . "/" . $item;
        if (is_dir($path)) {
            deleteDir($path);
        } else {
            unlink($path);
        }
    }
    rmdir($dir);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginInput = trim($_POST["login"]);

    $baseDir = "users";
    $userDir = $baseDir . "/" . $loginInput;

    if ($_SESSION["login"] === $loginInput) {
        if (is_dir($userDir)) {
            deleteDir($userDir);
            $message = "Папка $loginInput видалена";

            unset($_SESSION["login"]);
            unset($_SESSION["password"]);
        } else {
            $message = "Папка $loginInput не існує";
        }

    } else {
        $message = "Логін або пароль неправильні";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h2>Видалити папку користувача</h2>

<?php if (!empty($message)) echo "<p>$message</p>"; ?>

<form action="" method="post">
    <input type="text" name="login" required>
    <input type="password" name="password" required>
    <button type="submit">Видалити</button>
</form>
<a href="index.php">Назад</a>
</body>
</html>