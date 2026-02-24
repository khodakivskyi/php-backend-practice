<?php
$dir = "uploads";

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
    $tmpName = $_FILES["photo"]["tmp_name"];
    $originalName = basename($_FILES["photo"]["name"]);

    $destination = $dir . "/" . $originalName;

    if (move_uploaded_file($tmpName, $destination)) {
        echo "Файл завантажено у каталог $dir";
    } else {
        echo "Помилка завантаження файлу";
    }
}
