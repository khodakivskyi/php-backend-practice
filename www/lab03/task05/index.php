<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if ($login !== "" || $password !== "") {
        $baseDir = "users";
        $userDir = $baseDir . "/" . $login;

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        if (!is_dir($userDir)) {
            mkdir($userDir, 0777, true);

            $subdirs = ["video", "music", "photo"];
            foreach ($subdirs as $subdir) {
                mkdir($userDir . "/" . $subdir, 0777);

                file_put_contents($userDir . "/" . $subdir . "/example.txt", "тестовий_файл");
            }

            $_SESSION["login"] = $login;
            $_SESSION["password"] = $password;

            $message = "Папка для користувача $login створена";
        } else {
            $message = "Папка з ім’ям $login вже існує";
        }
    } else {
        $message = "Введіть логін та пароль!";
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

<h2>Створити папку користувача</h2>

<?php if (!empty($message)) echo "<p>$message</p>"; ?>

<form action="" method="post">
    <input type="text" name="login" required>
    <input type="password" name="password" required>
    <button type="submit">Вхід</button>
</form>

<a href="delete.php">Видалити</a>
</body>
</html>