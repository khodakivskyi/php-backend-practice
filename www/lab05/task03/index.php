<?php

try {
    $pdo = new PDO(
        'mysql:host=db;dbname=company_db;charset=utf8mb4',
        'root',
        'rootpass'
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($pdo === null) exit;

function fetchEmployees($pdo)
{
    try {
        $sql = "SELECT * FROM employees";
        return $pdo->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

$result = fetchEmployees($pdo);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

function toTable($rows)
{
    $fields = ["id", "name", "position", "salary"];

    echo "<table>";
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>" . $field . "</th>";
    }
    echo "</tr>";

    foreach ($rows as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td> $value</td>";

        }
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
        echo "<td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getAvgSalary($rows) {
    $sum = 0;
    foreach ($rows as $row) {
        $sum += $row['salary'];
    }

    return round($sum / count($rows), 2);
}

function getStatistics($rows){
    if($rows && count($rows) !== 0) {
        echo "<p>Загальна к-сть працівників: " . count($rows) . "</p>";
        echo "<p>Середня зароб плата: " . getAvgSalary($rows) . "</p>";
    }
}

toTable($rows);

getStatistics($rows);
?>

<a href="add.php">Add employee</a>
