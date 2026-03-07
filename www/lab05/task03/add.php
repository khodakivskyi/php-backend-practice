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

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $position = $_POST['position'] ?? '';
    $salary = $_POST['salary'] ?? '';

    if($name && $position && $salary && $pdo !== null) {
        $sql = "INSERT INTO employees (name, position, salary)
                VALUES ('$name', '$position', '$salary')";

        try{
            $pdo->exec($sql);
            $message = "New record created successfully";
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
    }

    header("Location: index.php");
}
?>

<h2>Add Employee</h2>
<?php if ($message) echo "<p>$message</p>"; ?>
<form method="post">
    <label>
        Name:
        <input type="text" name="name" required>
    </label>
    <br><br>

    <label>
        Position:
        <input type="text" name="position" required>
    </label>
    <br><br>

    <label>
        Salary:
        <input type="number" step="0.01" name="salary" required>
    </label>
    <br><br>

    <button type="submit">Add Employee</button>
</form>

<a href="index.php">Back</a>
