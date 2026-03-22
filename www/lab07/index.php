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
<a href="task01/cache_page.php">Task01</a><br>
<a href="task02/rate_limit.php">Task02</a><br>
<a href="task03/error_handler.php">Task03</a><br>
<a href="task04/redirect_manager.php">Task04</a><br>
<a href="task05/index.php">Task05</a><br>
<a href="task06/utils/stats.php">Task06</a><br>
<a href="test404.php">test404</a><br>
</body>
</html>

<?php
register_shutdown_function(function() {
    require_once('task06/traffic_logger.php');
});
?>