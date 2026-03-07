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
$id = $_GET['id'];

if ($id) {
    $sql = "SELECT * FROM employees WHERE id=$id";

    try {
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $position = $_POST['position'] ?? '';
    $salary = $_POST['salary'] ?? '';

    if($name && $position && $salary && $pdo !== null) {
        $sql = "UPDATE employees SET name=:name, position=:position, salary=:salary WHERE id=:id";

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':salary', $salary);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $message = "Employee updated successfully!";
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }

        header("Location: edit.php?id=$id&result=$message");
        exit;
    }
}
?>

<h2>Edit Employee</h2>
<?php
if (isset($_GET['result'])) {
    $message = $_GET['result'];
    echo "<p>$message</p>";
}
?>
<form method="post">
    <label>
        Name:
        <input type="text" name="name" value="<?= htmlspecialchars($rows['name'] ?? '') ?>" required>
    </label>
    <br><br>

    <label>
        Position:
        <input type="text" name="position" value="<?= htmlspecialchars($rows['position'] ?? '') ?>" required>
    </label>
    <br><br>

    <label>
        Salary:
        <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($rows['salary'] ?? '') ?>" required>
    </label>
    <br><br>

    <button type="submit">Update Employee</button>
</form>

<a href="index.php">Back</a>
