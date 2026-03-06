<?php
include_once("./classes/User.php");
include_once("./classes/Service.php");
include_once("./classes/Database.php");

use classes\Service;
use classes\Database;
use classes\User;

session_start();

$loggedInUser = $_SESSION['User'] ?? null;

if (!$loggedInUser) {
    header("Location: index.php");
    exit;
}

$db = new Database();
$service = new Service($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedUser = new \classes\User([
        'id' => $loggedInUser->id,
        'login' => $_POST['login'] ?? $loggedInUser->login,
        'email' => $_POST['email'] ?? $loggedInUser->email,
        'name' => $_POST['name'] ?? $loggedInUser->name,
        'surname' => $_POST['surname'] ?? $loggedInUser->surname,
        'phone' => $_POST['phone'] ?? $loggedInUser->phone,
        'address' => $_POST['address'] ?? $loggedInUser->address,
        'birth_date' => $_POST['birth_date'] ?? $loggedInUser->birth_date,
        'avatar_url' => $_POST['avatar_url'] ?? $loggedInUser->avatar_url,
        'user_role' => $loggedInUser->user_role,
        'password' => $loggedInUser->password,
    ]);

    $savedUser = $service->updateUser($updatedUser);

    if ($savedUser) {
        $_SESSION['User'] = $savedUser;
        $success = "Profile updated successfully!";
    } else {
        $error = "Failed to update profile.";
    }
}
?>

<h2>Edit Profile</h2>
<?php if (!empty($success)) echo "<p style='color:green'>$success</p>"; ?>
<form method="post">
    <label>Username: <input type="text" name="login" value="<?= htmlspecialchars($loggedInUser->login ?? '') ?>"></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($loggedInUser->email ?? '') ?>"></label><br>
    <label>First Name: <input type="text" name="name" value="<?= htmlspecialchars($loggedInUser->name ?? '') ?>"></label><br>
    <label>Last Name: <input type="text" name="surname" value="<?= htmlspecialchars($loggedInUser->surname ?? '') ?>"></label><br>
    <label>Phone: <input type="text" name="phone" value="<?= htmlspecialchars($loggedInUser->phone ?? '') ?>"></label><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($loggedInUser->address ?? '') ?>"></label><br>
    <button type="submit">Save</button>
</form>
<p><a href="index.php">Back to Home</a></p>