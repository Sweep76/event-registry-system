<?php 
include "layout/header.php"; 

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
} 

include "tools/db.php"; // Assuming this contains the function to connect to the database
$dbConnection = getDatabaseConnection();

// Check if the order ID is provided
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Fetch the order details
    $statement = $dbConnection->prepare(
        "SELECT o.order_id, o.order_quantity, p.id AS product_id, p.name AS product_name, p.price 
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.order_id = ?;"
    );

    $statement->bind_param("i", $orderId);
    $statement->execute();
    $result = $statement->get_result();

    // Check if the order exists
    if ($result->num_rows === 1) {
        $order = $result->fetch_assoc();
    } else {
        die("Order not found.");
    }
} else {
    die("No order ID provided.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newQuantity = $_POST['order_quantity'];

    // Update the order in the database
    $updateStatement = $dbConnection->prepare(
        "UPDATE orders SET order_quantity = ? WHERE order_id = ?;"
    );
    $updateStatement->bind_param("ii", $newQuantity, $orderId);
    $updateStatement->execute();

    if ($updateStatement->affected_rows > 0) {
        // Redirect to the orders page after successful update
        header("Location: orders.php");
        exit();
    } else {
        echo "<p>Failed to update order.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Order</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" value="<?php echo htmlspecialchars($order['product_name']); ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="order_quantity" class="form-label">Order Quantity</label>
            <input type="number" class="form-control" id="order_quantity" name="order_quantity" value="<?php echo htmlspecialchars($order['order_quantity']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="orders.php" class="btn btn-secondary">Cancel</a> <!-- Cancel button -->
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
