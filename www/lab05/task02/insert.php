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

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $category = $_POST['category'] ?? '';

    if ($name && $price && $quantity && $category && $pdo !== null) {
        $sql = "INSERT INTO tov (name, price, quantity, category) 
                VALUES ('$name', '$price', '$quantity', '$category')";

        try {
            $pdo->exec($sql);
            $success = "Record added successfully!";
        } catch (PDOException $e) {
            $error = "Failed to add record: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<h2>Add New Record</h2>

<?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Price: <input type="number" name="price" step="0.01" required></label><br>
    <label>Quantity: <input type="number" name="quantity" required></label><br>
    <label>Category: <input type="text" name="category" required></label><br>
    <button type="submit">Add Record</button>
</form>

<p><a href="index.php">Back</a></p>