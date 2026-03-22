<?php
$cacheFile = 'cache.html';

$status = 200;

if ($status === 200 && file_exists($cacheFile) && filesize($cacheFile) > 0) {
    echo file_get_contents($cacheFile);
    exit;
}

ob_start();

http_response_code($status);

echo "<h1>Моя сторінка</h1>";
echo "<p>Час генерації: " . date('H:i:s') . "</p>";

if($status == 200) {
    file_put_contents($cacheFile, ob_get_contents());
} elseif ($status == 404) {
    if(file_exists($cacheFile)) {
        unlink($cacheFile);
    }
}

ob_end_flush();
