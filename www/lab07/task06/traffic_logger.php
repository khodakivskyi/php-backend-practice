<?php
include_once("utils/db.php");

$pdo = dbConnect();

$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['REQUEST_URI'];
$status = http_response_code();

addLog($ip, $url, $status, $pdo);

function addLog($ip, $url, $status, $pdo) {
    try{
        $stmt = $pdo->prepare("
    INSERT INTO traffic_logs (ip_address, request_url, status_code)
    VALUES (:ip, :url, :status)");

        $stmt->execute([
            ':ip' => $ip,
            ':url' => $url,
            ':status' => $status
        ]);
    } catch (PDOException) {
        return null;
    }
}