<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    echo "User not logged in";
    exit;
}

// Check if user_id is set in session
if (!isset($_SESSION["id"])) {
    echo "User ID not found in session";
    exit;
}

// Database connection
include "tools/db.php";
$dbConnection = getDatabaseConnection();

// Assuming you're getting product_id and quantity from a form
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$order_quantity = isset($_POST['order_quantity']) ? (int)$_POST['order_quantity'] : 1;  
$customer_id = $_SESSION['id']; // Use the session variable for customer ID

// Check if order_quantity is valid
if ($order_quantity <= 0) {
    echo "Invalid quantity.";
    exit;
}

// Prepare the SQL statement to insert the order
$statement = $dbConnection->prepare("INSERT INTO orders (customer_id, product_id, order_quantity) VALUES (?, ?, ?)");
if ($statement) {
    $statement->bind_param("iii", $customer_id, $product_id, $order_quantity);
    if ($statement->execute()) {
        // Order placed successfully, now redirect
        header("Location: product_list.php");
        exit; // Always call exit after header redirection
    } else {
        echo "Error executing statement: " . $statement->error;
    }
} else {
    echo "Error preparing statement: " . $dbConnection->error;
}
?>
