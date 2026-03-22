<?php
ob_start();

$redirectFile = 'redirects.json';

if (!file_exists($redirectFile)) {
    die("Redirect file $redirectFile does not exist");
}

$redirects = json_decode(file_get_contents("redirects.json"), true);
if($redirects === null) {
    die("Incorrect redirect file content");
}

$requestUrl = str_replace('/lab07/task04/redirect_manager.php', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if(isset($redirects[$requestUrl])) {
    $targetUrl = $redirects[$requestUrl];

    if ($targetUrl === '/404') {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
    } else {
        http_response_code(301);
        header("Location: $targetUrl", true, 301);
    }
} else {
    http_response_code(200);
    echo "<h1>Сторінка працює нормально</h1>";
    echo "<p>URL: $requestUrl</p>";
}

ob_end_flush();