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

$id = isset($_GET['id']) ? $_GET['id'] : null;

if($id && $pdo != null){
    $sql = "DELETE FROM employees WHERE id = :id";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $message = "Employee deleted successfully!";
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }

    if($message){
        header("Location: delete.php?&result=$message");
        exit;
    }
}

?>

<h2>Delete Employee</h2>
<?php
if (isset($_GET['result'])) {
    $message = $_GET['result'];
    echo "<p>$message</p>";
}
?>

<a href="index.php">Back</a>
