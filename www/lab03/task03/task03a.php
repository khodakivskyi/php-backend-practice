<?php

$file = "comments.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]) ?? "";
    $comment = trim($_POST["comment"]) ?? "";

    if ($name !== "" && $comment !== "") {
        $name = str_replace(["\n", "\r", "|"], "", $name);
        $comment = str_replace(["\n", "\r", "|"], "", $comment);

        $line = $name . "|" . $comment . PHP_EOL;

        $handle = fopen($file, "a");
        fwrite($handle, $line);
        fclose($handle);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
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
    <input type="text" name="name" placeholder="Ім’я" required>
    <textarea name="comment" placeholder="Коментар" required></textarea>
    <button type="submit">Додати</button>
</form>

<h2>Коментарі</h2>

<table border="1">
    <tr>
        <th>Ім’я</th>
        <th>Коментар</th>
    </tr>

    <?php

    if (file_exists($file)){
        $handle = fopen($file, "r");

        while (!feof($handle)) {
            $line = fgets($handle);

            if ($line !== false) {
                $line = trim($line);

                if($line !== ""){
                    $parts = explode("|", $line);

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($parts[0]) . "</td>";
                    echo "<td>" . htmlspecialchars($parts[1]) . "</td>";
                    echo "</tr>";
                }
            }
        }
    }
    ?>
</table>
</body>
</html>
