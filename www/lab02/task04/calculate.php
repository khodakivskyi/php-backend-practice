<?php
require 'Function/func.php';

$x = $_POST['x'] ?? 0;
$y = $_POST['y'] ?? 0;

$xy = xy($x, $y);
$factorial = factorial($x);
$my_tg = my_tg($x);
$sinx = my_sin($x);
$cosx = my_cos($x);
$tgx = my_tan($x);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результат обчислень</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: yellow;
        }
    </style>
</head>
<body>

<h1>Результати обчислень</h1>
<table>
    <tr>
        <th>x^y</th>
        <th>x!</th>
        <th>my_tg(x)</th>
        <th>sin(x)</th>
        <th>cos(x)</th>
        <th>tg(x)</th>
    </tr>
    <tr>
        <td><?= htmlspecialchars($xy) ?></td>
        <td><?= htmlspecialchars($factorial) ?></td>
        <td><?= htmlspecialchars($my_tg) ?></td>
        <td><?= htmlspecialchars($sinx) ?></td>
        <td><?= htmlspecialchars($cosx) ?></td>
        <td><?= htmlspecialchars($tgx) ?></td>
    </tr>
</table>

<br>
<a href="index.php">Назад до форми</a>

</body>
</html>
