<?php
include 'connection.php';
$id = $_GET['id'];
$product = $con->query("SELECT * FROM shop_products WHERE id = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="<?php echo $product['image']; ?>" width="200"><br>
    <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
    <p><strong>Price:</strong> ₹<?php echo $product['price']; ?></p>
    <a href="dashboard.php">Back to Home</a>
    
</body>
</html>
