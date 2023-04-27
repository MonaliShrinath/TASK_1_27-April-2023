<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        th, td {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'username', 'password', 'your_database_name');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch product data from the database
    $sql = "SELECT p.ProductId, p.ProductName, c.CategoryName, p.CategoryId 
            FROM products p
            INNER JOIN categories c ON p.CategoryId = c.CategoryId";
    $result = mysqli_query($conn, $sql);

    // Check if there are any products
    if (mysqli_num_rows($result) > 0) {
        // Display the product list
        echo "<table>
                <tr>
                    <th>ProductId</th>
                    <th>ProductName</th>
                    <th>CategoryName</th>
                    <th>CategoryId</th>
                    <th>Actions</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>".$row["ProductId"]."</td>
                    <td>".$row["ProductName"]."</td>
                    <td>".$row["CategoryName"]."</td>
                    <td>".$row["CategoryId"]."</td>
                    <td>
                        <a href='view_product.php?ProductId=".$row["ProductId"]."'>View</a>
                        <a href='edit_product.php?ProductId=".$row["ProductId"]."'>Edit</a>
                        <a href='delete_product.php?ProductId=".$row["ProductId"]."' onClick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
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