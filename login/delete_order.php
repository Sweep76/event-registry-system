<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Check if the order_id is set in POST
if (!isset($_POST['order_id'])) {
    echo "Order ID not provided.";
    exit;
}

// Database connection
include "tools/db.php";
$dbConnection = getDatabaseConnection();

$order_id = (int)$_POST['order_id']; // Sanitize order_id
$user_id = $_SESSION['id']; // Get the logged-in user ID

// Prepare the SQL statement to delete the order
$statement = $dbConnection->prepare("DELETE FROM orders WHERE order_id = ? AND customer_id = ?");
if ($statement) {
    $statement->bind_param("ii", $order_id, $user_id);
    if ($statement->execute()) {
        // Redirect back to the orders page after deletion
        header("Location: orders.php");
        exit;
    } else {
        echo "Error deleting order: " . $statement->error;
    }
} else {
    echo "Error preparing statement: " . $dbConnection->error;
}
?>
