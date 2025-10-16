<?php
session_start();
include 'connection.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        $errors[] = "Please fill all fields.";
    } else {
        $stmt = $con->prepare("SELECT id, username, password FROM shop_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $uname, $hash);
        if ($stmt->fetch() && password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $uname;
            header("Location:dashboard.php");
            exit;
        } else {
            $errors[] = "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<?php foreach ($errors as $e) echo "<p style='color:red'>$e</p>"; ?>
<form method="POST">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a> | <a href="home.php">Home</a></p>

</body>
</html>
