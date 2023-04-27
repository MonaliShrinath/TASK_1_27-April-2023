<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <p><a href="add_product.php">Add New Product</a></p>
    <?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'example_db');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch product data from the database
    $sql = "SELECT p.ProductId, p.ProductName, c.CategoryName, p.CategoryId 
            FROM products p
            INNER JOIN categories c ON p.CategoryId = c.CategoryId";
    $result = mysqli_query($conn, $sql);

    // Check if products are found
    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ProductId</th>
                    <th>ProductName</th>
                    <th>CategoryName</th>
                    <th>CategoryId</th>
                    <th>Actions</th>
                </tr>";
        // Loop through each product and display in table rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row["ProductId"]."</td>
                    <td>".$row["ProductName"]."</td>
                    <td>".$row["CategoryName"]."</td>
                    <td>".$row["CategoryId"]."</td>
                    <td>
                        <a href='view_product.php?ProductId=".$row["ProductId"]."'>View</a>
                        <a href='edit_product.php?ProductId=".$row["ProductId"]."'>Edit</a>
                        <a href='delete_product.php?ProductId=".$row["ProductId"]."'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No products found.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</body>
</html>