<?php
session_start();
include 'connection.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($username === '') $errors[] = "Username required.";
    if (strlen($password) < 4) $errors[] = "Password must be at least 4 characters.";
    if ($password !== $confirm) $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        $stmt = $con->prepare("SELECT id FROM shop_users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Username already exists.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $con->prepare("INSERT INTO shop_users (username, password) VALUES (?, ?)");
            $ins->bind_param("ss", $username, $hash);
            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                $_SESSION['username'] = $username;
                header("Location: login.php");
                exit;
            } else {
                $errors[] = "Registration failed.";
            }
            $ins->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Register</h2>
<?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>
<form method="POST">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    Confirm Password:<br>
    <input type="password" name="confirm" required><br><br>
    <button type="submit">Register</button>
</form>
<p><a href="login.php">Login</a> | <a href="home.php">Home</a></p>
</body>
</html>
