<?php 
include "layout/header.php"; 

// Check if the user is logged in
if(!isset($_SESSION["email"])){
    header("location: login.php");
    exit;
} 

include "tools/db.php"; // Assuming this contains the function to connect to the database
$dbConnection = getDatabaseConnection();

// Fetch the user ID from the session
$userId = $_SESSION['id']; // Ensure user ID is stored in session on login

// Prepare the SQL statement to get the user's orders
$statement = $dbConnection->prepare(
    "SELECT p.name AS product_name, o.order_date, o.order_status
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE o.customer_id = ?"
);

// Bind the user ID to the query
$statement->bind_param("i", $userId);
$statement->execute();
$result = $statement->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
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

<h2>Your Orders</h2>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if the query returned any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["product_name"]) . "</td>
                        <td>" . htmlspecialchars($row["order_date"]) . "</td>
                        <td>" . htmlspecialchars($row["order_status"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No orders found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php include "layout/footer.php"; ?>
