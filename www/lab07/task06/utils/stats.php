<?php
include_once("db.php");

$pdo = dbConnect();
$total = getReqsCount($pdo);
$errors = getReqsErrors($pdo);

function getReqsCount($pdo) {
    try{
        $totalStmt = $pdo->query("
    SELECT COUNT(*) as total
    FROM traffic_logs
    WHERE created_at >= NOW() - INTERVAL 1 DAY");

        return $totalStmt->fetch()['total'];
    } catch (PDOException) {
        return null;
    }
}

function getReqsErrors($pdo) {
    try{
        $totalStmt = $pdo->query("
    SELECT COUNT(*) as total
    FROM traffic_logs
    WHERE status_code = 404 AND created_at >= NOW() - INTERVAL 1 DAY");

        return $totalStmt->fetch()['total'];
    } catch (PDOException) {
        return null;
    }
}

$percent = $total > 0 ? ($errors / $total) * 100 : 0;

echo "<h1>Статистика за 24 години</h1>";
echo "<p>Всього запитів: $total</p>";
echo "<p>404 помилок: $errors</p>";
echo "<p>Відсоток 404: " . round($percent, 2) . "%</p>";

if ($percent > 10) {
    echo "<h2 style='color:red;'>404 errors!</h2>";
}