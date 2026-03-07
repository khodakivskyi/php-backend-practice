<?php

try {
    $pdo = new PDO(
            'mysql:host=db;dbname=lab5;charset=utf8mb4',
            'root',
            'rootpass'
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($pdo === null) exit;

function fetchTovs($pdo)
{
    try {
        $sql = "SELECT * FROM tov";
        return $pdo->query($sql);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

$result = fetchTovs($pdo);
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

function toTable($rows)
{
    $fields = ["id", "name", "price", "quantity", "category"];

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
        echo "</tr>";
    }
    echo "</table>";
}

?>

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
<?php
    toTable($rows);
?>
<a href="insert.php">Add record</a>

<input type="number" id="deleteId" placeholder="Record ID">
<button type="button" onclick="deleteRow()">Delete record</button>

<script>
    function deleteRow() {
        const id = document.querySelector('#deleteId').value;
        if (!id) {
            alert("Please enter a record ID.");
        } else {
            window.location.href = `delete.php?id=${id}`;
        }
    }
</script>
</body>
</html>
