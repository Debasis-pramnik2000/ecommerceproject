<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <style>
        body {
            font-family: Arial;
            background-color: yellowgreen;
            color: #333;
            text-align: center;
        }
        .flip img { height: 200px; width: 200px; }
        ul { list-style: none; padding: 0; }
        li { margin: 10px 0; }
        a { text-decoration: none; color: blue; }
        .topbar { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="flip"><img src="flip.png" alt=""></div>

    <div class="topbar">
    <?php if (isset($_SESSION['user_id'])): ?>
        Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> |
       
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
    </div>

    
    <marquee>Welcome to visit my website</marquee>
</body>
</html>
