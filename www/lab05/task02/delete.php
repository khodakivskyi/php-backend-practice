<?php
try {
    $pdo = new PDO(
        'mysql:host=db;dbname=lab5;charset=utf8mb4',
        'root',
        'rootpass'
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$id = $_GET["id"];

if ($id !== null && $pdo !== null) {
    $id = (int)$id;
    $sql = "DELETE FROM tov WHERE id = $id";

    try{
        $rows = $pdo->exec($sql);
        if ($rows) {
            echo "Record with ID $id deleted successfully.";
        } else {
            echo "No record found with ID $id.";
        }
    }
    catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
} else {
    echo "No ID specified.";
}

?>

<p><a href="index.php">Back</a></p>
