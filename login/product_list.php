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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 20px auto;
            max-width: 900px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2 class="text-center mt-4">Product List</h2>
    <table class="table table-striped">
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
                            <td>$" . number_format(htmlspecialchars($row["price"]), 2) . "</td>
                            <td>" . htmlspecialchars($row["quantity"]) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No products found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include "layout/footer.php"; ?>
