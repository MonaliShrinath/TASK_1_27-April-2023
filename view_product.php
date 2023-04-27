<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
</head>
<body>
    <h1>View Product</h1>
    <?php
    // Get the selected ProductId from the URL
    if (isset($_GET['ProductId'])) {
        $ProductId = $_GET['ProductId'];

        // Connect to the database
        $conn = mysqli_connect('localhost', 'username', 'password', 'your_database_name');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch product data from the database for the selected ProductId
        $sql = "SELECT p.ProductId, p.ProductName, c.CategoryName, p.CategoryId 
                FROM products p
                INNER JOIN categories c ON p.CategoryId = c.CategoryId
                WHERE p.ProductId = $ProductId";
        $result = mysqli_query($conn, $sql);

        // Check if the product is found
        if (mysqli_num_rows($result) == 1) {
            // Display the product details
            $row = mysqli_fetch_assoc($result);
            echo "<h2>Product Details</h2>
                    <p><strong>ProductId: </strong>".$row["ProductId"]."</p>
                    <p><strong>ProductName: </strong>".$row["ProductName"]."</p>
                    <p><strong>CategoryName: </strong>".$row["CategoryName"]."</p>
                    <p><strong>CategoryId: </strong>".$row["CategoryId"]."</p>";
        } else {
            echo "Product not found.";
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        echo "No ProductId provided.";
    }
    ?>
    <p><a href="product_list.php">Back to Product List</a></p>
</body>
</html>