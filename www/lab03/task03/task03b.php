<?php
function createFiles()
{
    $file1 = "file1.txt";
    $file2 = "file2.txt";

    $words1 = preg_split('/\s+/', file_get_contents($file1));
    $words2 = preg_split('/\s+/', file_get_contents($file2));

    $onlyInFile1 = array_diff($words1, $words2);
    file_put_contents("only_in_file1.txt", implode(" ", $onlyInFile1));

    $inBoth = array_intersect($words1, $words2);
    $inBoth = array_unique($inBoth);
    file_put_contents("in_both.txt", implode(" ", $inBoth));

    $count1 = array_count_values($words1);
    $count2 = array_count_values($words2);

    $moreThanTwo = [];
    foreach ($count1 as $word => $c1) {
        if ($c1 > 2 && isset($count2[$word]) && $count2[$word] > 2) {
            $moreThanTwo[] = $word;
        }
    }
    file_put_contents("more_than_two.txt", implode(" ", $moreThanTwo));
}

createFiles();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = trim($_POST["filename"]);

    $allowed = ["only_in_file1.txt", "in_both.txt", "more_than_two.txt"];

    if (in_array($filename, $allowed)) {
        if (file_exists($filename)) {
            unlink($filename);
            echo "<p>Файл $filename видалено</p>";
        } else {
            echo "<p>Файл $filename не існує</p>";
        }
    } else {
        echo "<p>Виникла помилка при видаленні файлу</p>";
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
<form method="post">
    <label>Ім’я файлу для видалення:</label>
    <input type="text" name="filename" placeholder="наприклад only_in_file1.txt" required>
    <button type="submit">Видалити файл</button>
</form>
</body>
</html>
