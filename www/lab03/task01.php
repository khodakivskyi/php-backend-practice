<?php
if (isset($_GET['fontSize']) && in_array($_GET['fontSize'], ['small','medium','large'])) {
    setcookie('fontSize', $_GET['fontSize'], time() + 86400*30, "/");
    header("Location: task01.php");
    exit;
}

$fontSize = $_COOKIE['fontSize'] ?? 'medium';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body.small {
            font-size: 14px;
        }

        body.medium {
            font-size: 18px;
        }

        body.large {
            font-size: 24px;
        }
    </style>
</head>
<body class="<?php echo $fontSize; ?>">
<div class="font-controls">
    <a href="?fontSize=large">Великий шрифт</a>
    <a href="?fontSize=medium">Середній шрифт</a>
    <a href="?fontSize=small">Маленький шрифт</a>
</div>
</body>
</html>
