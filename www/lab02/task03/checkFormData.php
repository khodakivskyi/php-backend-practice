<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"] ?? '';
    $password = $_POST["password"] ?? '';
    $password2 = $_POST["password2"] ?? '';
    $gender = $_POST["gender"] ?? '';
    $city = $_POST["city"] ?? '';
    $games = $_POST["games"] ?? [];
    $about = $_POST["about"] ?? '';

    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;
    $_SESSION["password2"] = $password2;
    $_SESSION["gender"] = $gender;
    $_SESSION["city"] = $city;
    $_SESSION["games"] = $games;
    $_SESSION["about"] = $about;

    $passwordCheck = ($password !== $password2) ? "Паролі не співпадають!" : "Паролі співпадають!";

    $photoPath = "";

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {

        $uploadDir = "uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFile = $uploadDir . $fileName;

        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

        $photoPath = $targetFile;
    }
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат реєстрації</title>
</head>
<body>

<h1>Дані користувача</h1>

<p><strong>Логін:</strong> <?= htmlspecialchars($login) ?></p>
<p><strong>Пароль:</strong> <?= htmlspecialchars($passwordCheck) ?></p>
<p><strong>Стать:</strong> <?= htmlspecialchars($gender) ?></p>
<p><strong>Місто:</strong> <?= htmlspecialchars($city) ?></p>

<p><strong>Улюблені ігри:</strong>
    <?php
    if (!empty($games)) {
        echo implode(", ", $games);
    } else {
        echo "Не обрано";
    }
    ?>
</p>

<p><strong>Про себе:</strong><br>
    <?= nl2br($about) ?>
</p>

<?php if (!empty($photoPath)) : ?>
    <p><strong>Фотографія:</strong></p>
    <img src="<?= $photoPath ?>" width="200">
<?php else : ?>
    <p><strong>Фотографія не завантажена</strong></p>
<?php endif; ?>
<br>
<a href="index.php">Назад до форми</a>
</body>
</html>
