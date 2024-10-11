<?php 
include "layout/header.php"; 

// Check if the user is logged in
if(!isset($_SESSION["email"])){
    header("location: login.php");
    exit;
} 

include "tools/db.php"; // Assuming this contains the function to connect to the database
$dbConnection = getDatabaseConnection();

// Get the order ID from the URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Delete the order from the database
if ($orderId > 0) {
    $statement = $dbConnection->prepare("DELETE FROM orders WHERE id = ?");
    $statement->bind_param("i", $orderId);
    $statement->execute();
}

// Redirect back to orders page
header("Location: orders.php");
exit;
