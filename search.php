<?php
include 'connection.php';
$query = $con->real_escape_string($_GET['q']);
$products = $con->query("SELECT * FROM shop_products WHERE name LIKE '%$query%' OR description LIKE '%$query%'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results for "<?php echo htmlspecialchars($query); ?>"</title>
</head>
<body>
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    <ul>
        <?php if ($products->num_rows > 0): ?>
            <?php while ($product = $products->fetch_assoc()): ?>
                <li>
                    <a href="product.php?id=<?php echo $product['id']; ?>">
                        <?php echo $product['name']; ?> - ₹<?php echo $product['price']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </ul>
    <a href="home.php">Back to Home</a>
</body>
</html>
