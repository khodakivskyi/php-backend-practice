<?php
session_start();

$login = $_SESSION["login"] ?? '';
$password = $_SESSION["password"] ?? '';
$password2 = $_SESSION["password2"] ?? '';
$gender = $_SESSION["gender"] ?? '';
$city = $_SESSION["city"] ?? '';
$games = $_SESSION["games"] ?? [];
$about = $_SESSION["about"] ?? '';


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    $sixMonths = 6*30*24*60*60;
    setcookie("lang", $lang, time() + $sixMonths);

    $_COOKIE['lang'] = $lang;
}

$selectedLang = $_COOKIE['lang'] ?? 'ukr';

$langText = match ($selectedLang) {
    'ukr' => "Вибрана мова: Українська",
    'eng' => "Selected language: English",
    'ger' => "Ausgewählte Sprache: Deutsch",
    default => "Вибрана мова: Українська",
};
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
    <style>
        a.icon{
            text-decoration: none;
            flex: 1;
        }
    </style>
</head>
<body>

<h1>Форма реєстрації</h1>

<form action="checkFormData.php" method="post" enctype="multipart/form-data">

    <label for="login">Логін:</label>
    <input type="text" name="login" id="login"
           value="<?= htmlspecialchars($login) ?>" required>
    <br><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password"
           value="<?= htmlspecialchars($password) ?>" required>
    <br><br>

    <label for="password2">Пароль (ще раз):</label>
    <input type="password" name="password2" id="password2"
           value="<?= htmlspecialchars($password2) ?>" required>
    <br><br>

    <label>Стать:</label>
    <input type="radio" name="gender" value="чоловік" id="male"
            <?= ($gender === "чоловік") ? "checked" : "" ?>>
    <label for="male">чоловік</label>

    <input type="radio" name="gender" value="жінка" id="female"
            <?= ($gender === "жінка") ? "checked" : "" ?>>
    <label for="female">жінка</label>
    <br><br>

    <label for="city">Місто:</label>
    <select name="city" id="city">
        <option value="Житомир" <?= ($city === "Житомир") ? "selected" : "" ?>>Житомир</option>
        <option value="Київ" <?= ($city === "Київ") ? "selected" : "" ?>>Київ</option>
        <option value="Львів" <?= ($city === "Львів") ? "selected" : "" ?>>Львів</option>
        <option value="Одеса" <?= ($city === "Одеса") ? "selected" : "" ?>>Одеса</option>
    </select>
    <br><br>

    <label>Улюблені ігри:</label><br>

    <input type="checkbox" name="games[]" value="футбол" id="football"
            <?= in_array("футбол", $games) ? "checked" : "" ?>>
    <label for="football">футбол</label><br>

    <input type="checkbox" name="games[]" value="баскетбол" id="basketball"
            <?= in_array("баскетбол", $games) ? "checked" : "" ?>>
    <label for="basketball">баскетбол</label><br>

    <input type="checkbox" name="games[]" value="волейбол" id="volleyball"
            <?= in_array("волейбол", $games) ? "checked" : "" ?>>
    <label for="volleyball">волейбол</label><br>

    <input type="checkbox" name="games[]" value="шахи" id="chess"
            <?= in_array("шахи", $games) ? "checked" : "" ?>>
    <label for="chess">шахи</label><br>

    <input type="checkbox" name="games[]" value="World of Tanks" id="wot"
            <?= in_array("World of Tanks", $games) ? "checked" : "" ?>>
    <label for="wot">World of Tanks</label><br><br>

    <label for="about">Про себе:</label><br>
    <textarea name="about" id="about" rows="5" cols="40"><?= htmlspecialchars($about) ?></textarea>
    <br><br>

    <label for="photo">Фотографія:</label>
    <input type="file" name="photo" id="photo">
    <br><br>

    <input type="submit" value="Зареєструватися">

</form>

<h2>Виберіть мову:</h2>
<a class="icon" href="index.php?lang=ukr">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Flag_of_Ukraine.svg/960px-Flag_of_Ukraine.svg.png" alt="Українська" width="50">
</a>
<a class="icon" href="index.php?lang=eng">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Flag_of_the_United_Kingdom_%283-5%29.svg/1280px-Flag_of_the_United_Kingdom_%283-5%29.svg.png" alt="English" width="50">
</a>
<a class="icon" href="index.php?lang=ger">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Flag_of_Germany.svg/3840px-Flag_of_Germany.svg.png" alt="Germany" width="50">
</a>

<h2><?= $langText ?></h2>
</body>
</html>
