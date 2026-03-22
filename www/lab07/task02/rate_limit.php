<?php
$logFile = 'requests.log';
$clientIp = $_SERVER['REMOTE_ADDR'];

$requests = [];

if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        list($ip, $time) = explode('|', $line);
        if (time() - (int)$time <= 60) $requests[] = ['ip' => $ip, 'time' => $time];
    }
}

$count = 0;
foreach ($requests as $request) {
    if ($request['ip'] == $clientIp) $count++;
}

$requests[] = ['ip' => $clientIp, 'time' => time()];

$lines = [];
foreach ($requests as $request) {
    $lines[] = $request['ip'] . '|' . $request['time'];
}

file_put_contents($logFile, implode("\n", $lines));

ob_start();

if ($count >= 5) {
    http_response_code(429);
    echo "<h1>429 Too Many Requests</h1>";
} else {
    http_response_code(200);
    echo "<h1>OK</h1>";
}

ob_end_flush();