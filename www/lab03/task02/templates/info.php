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
<h1>Hello, <?=$_SESSION["login"]?></h1>
<a href="./?logout=1">Logout</a>
</body>
</html>
