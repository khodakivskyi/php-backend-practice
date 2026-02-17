<?php
$output = "";

//1.1
if (isset($_POST["replaceSubmit"])) {
    $text = $_POST["text"] ?? "";
    $find = $_POST["find"] ?? "";
    $replace = $_POST['replace'] ?? "";

    $result = str_replace($find, $replace, $text);
    $output = "Результат заміни: " . $result;
}

//1.2
function sortCities($citiesStr)
{
    $arr = explode(" ", $citiesStr);
    sort($arr, SORT_STRING | SORT_FLAG_CASE);
    return implode(" ", $arr);
}

if (isset($_POST["sortSubmit"])) {
    $citiesStr = $_POST["cities"] ?? "";

    $result = sortCities($citiesStr);
    $output = "Відсортовані міста: " . $result;
}

//1.3
if (isset($_POST["fileSubmit"])) {
    $filepath = $_POST["filePath"] ?? "";

    $filepath = str_replace("\\", "/", $filepath);
    $result = pathinfo($filepath, PATHINFO_FILENAME);

    $output = "Ім'я файлу без розширення: " . $result;
}

//1.4
if (isset($_POST["dateSubmit"])) {
    $firstDate = $_POST["firstDate"] ?? "";
    $secondDate = $_POST["secondDate"] ?? "";

    $d1 = DateTime::createFromFormat("d-m-Y", $firstDate);
    $d2 = DateTime::createFromFormat("d-m-Y", $secondDate);

    $diff = $d1->diff($d2);
    $days = $diff->days;

    $output = "Kількість днів між датами: " . $days;
}

//1.5
$result = "";
$createdPassword = $_POST["createdPassword"] ?? null;
function generatePassword($length) {
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $chars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $chars .= "0123456789";
    $chars .= "!@#$%^&*?";

    $password = "";
    $maxIndex = strlen($chars) - 1;

    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, $maxIndex)];
    }

    return $password;
}

function isStrongPassword($password)
{
    if (strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[$@#*]/', $password) ) {
        return false;
    }

    return true;
}

if (isset($_POST["createPasswordSubmit"])) {
    $passwordLength = $_POST["passwordLength"];

    $createdPassword = generatePassword($passwordLength);

    $output = "Згенерований пароль: " . $createdPassword;

}

if (isset($_POST["checkPasswordSubmit"])) {
    $passwordToCheck = $_POST["passwordToCheck"];
    $createdPassword = $passwordToCheck;

    if (isStrongPassword($passwordToCheck)) {
        $result = "Пароль міцний";
    } else {
        $result = "Пароль слабкий";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат</title>
</head>
<body>
<p><?= $output ?></p>
<?php if (isset($createdPassword)) : ?>
    <form action="" method="post">
        <label>Перевірити пароль: </label>
        <input type="text" name="passwordToCheck" value="<?= htmlspecialchars($createdPassword) ?>"><br>
        <input type="hidden" name="createdPassword"
               value="<?= htmlspecialchars($createdPassword) ?>">
        <input type="submit" name="checkPasswordSubmit">
    </form>

    <?php if ($result !== "") : ?>
        <p><?= htmlspecialchars($result) ?></p>
    <?php endif; ?>
<?php endif; ?>
<a href="index.html">Назад до форми</a>
</body>
</html>
