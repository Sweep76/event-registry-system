<?php
// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    // Sanitize the id to prevent SQL injection (as a basic measure)
    $id = intval($_GET['id']);

    // Include database connection
    require 'db_connection.php';

    // Prepare and execute the SQL delete statement
    $stmt = $connection->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' indicates the integer type

    if ($stmt->execute()) {
        // Redirect to index.php after successful deletion
        header("location: /test/event-registry-system/index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // If no id is set, redirect back to index.php
    header("location: /test/event-registry-system/index.php");
    exit;
}

?>


