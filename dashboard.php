<?php
session_start();
include 'connection.php';
?>
<form action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search products..." required>
        <button type="submit">Search</button>
    </form>

    <h2>Categories</h2>
    <ul>
        <?php
        $result = $con->query("SELECT * FROM shop_categories");
        while ($row = $result->fetch_assoc()) {
            echo "<li>
                    <a href='category.php?id={$row['id']}'>
                        <img src='{$row['image']}' alt='' width='100' height='100'> {$row['name']}
                    </a>
                  </li>";
        }
        ?>
        <a href="logout.php">Logout</a>

    </ul>