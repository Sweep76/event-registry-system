<?php 
include "layout/header.php"; 

// Check if the user is logged in
if(!isset($_SESSION["email"])){
    header("location: login.php");
    exit;
} 

include "tools/db.php";
$dbConnection = getDatabaseConnection();

// Prepare the SQL statement to select products
$statement = $dbConnection->prepare("SELECT id, name, description, price, quantity FROM products");
$statement->execute();
$result = $statement->get_result(); // Fetch the results

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Product List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if the query returned any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["description"]) . "</td>
                        <td>" . htmlspecialchars($row["price"]) . "</td>
                        <td>" . htmlspecialchars($row["quantity"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php include "layout/footer.php"; ?>
