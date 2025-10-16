<?php
include 'connection.php';
$category_id = $_GET['id'];
$category = $con->query("SELECT name FROM shop_categories WHERE id = $category_id")->fetch_assoc();
$products = $con->query("SELECT * FROM shop_products WHERE category_id = $category_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $category['name']; ?></title>
</head>
<body>
    <h1>Category: <?php echo $category['name']; ?></h1>
    <ul>
        <?php while ($product = $products->fetch_assoc()): ?>
            <li>
                <a href="product.php?id=<?php echo $product['id']; ?>">
                    <img src="<?php echo $product['image']; ?>" width="60">
                    <?php echo $product['name']; ?> - ₹<?php echo $product['price']; ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
    <a href="dashboard.php">Back to categories</a>
</body>
</html>
