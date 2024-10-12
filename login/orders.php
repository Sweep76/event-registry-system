<?php 
include "layout/header.php"; 

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
} 

include "tools/db.php"; // Assuming this contains the function to connect to the database
$dbConnection = getDatabaseConnection();

// Fetch the user ID from the session
$userId = $_SESSION['id']; // Ensure user ID is stored in session on login

// Pagination logic
$limit = 5; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate offset for SQL query

// Prepare the SQL statement to get the user's orders with limit and offset
$statement = $dbConnection->prepare(
    "SELECT o.order_id AS order_id, p.name AS product_name, p.price, o.order_quantity, 
    (p.price * o.order_quantity) AS total_price, o.order_date, o.order_status  
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE o.customer_id = ? 
    LIMIT ? OFFSET ?;"
);

// Check if the statement preparation was successful
if (!$statement) {
    die("Preparation failed: " . $dbConnection->error);
}

// Bind the user ID, limit, and offset to the query
$statement->bind_param("iii", $userId, $limit, $offset);
$statement->execute();
$result = $statement->get_result();

// Fetch total number of orders to calculate total pages
$totalOrdersStmt = $dbConnection->prepare(
    "SELECT COUNT(*) AS total_orders FROM orders WHERE customer_id = ?;"
);
$totalOrdersStmt->bind_param("i", $userId);
$totalOrdersStmt->execute();
$totalOrdersResult = $totalOrdersStmt->get_result();
$totalOrders = $totalOrdersResult->fetch_assoc()['total_orders'];

$totalPages = ceil($totalOrders / $limit); // Calculate total pages
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-pending { background-color: #ffed85; } /* Yellow for pending */
        .bg-completed { background-color: #a4e7a4; } /* Green for completed */
        .bg-canceled { background-color: #f8d7da; } /* Red for canceled */
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Your Orders</h2>

    <div class="accordion" id="ordersAccordion">
        <?php
        // Check if the query returned any results
        if ($result->num_rows > 0) {
            // Output data of each row
            $counter = $offset;
            while ($row = $result->fetch_assoc()) {
                $counter++;
                
                // Determine background color class based on order status
                $statusClass = '';
                if ($row['order_status'] == 'Pending') {
                    $statusClass = 'bg-pending';
                } elseif ($row['order_status'] == 'Completed') {
                    $statusClass = 'bg-completed';
                } elseif ($row['order_status'] == 'Canceled') {
                    $statusClass = 'bg-canceled';
                }

                echo "
                <div class='accordion-item'>
                    <h2 class='accordion-header' id='heading$counter'>
                        <button class='accordion-button $statusClass' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$counter' aria-expanded='true' aria-controls='collapse$counter'>
                            Order #$counter - " . htmlspecialchars($row["product_name"]) . " (Status: " . htmlspecialchars($row["order_status"]) . ")
                        </button>
                    </h2>
                    <div id='collapse$counter' class='accordion-collapse collapse' aria-labelledby='heading$counter' data-bs-parent='#ordersAccordion'>
                        <div class='accordion-body'>
                            <strong>Product Name:</strong> " . htmlspecialchars($row["product_name"]) . "<br>
                            <strong>Price:</strong> $" . htmlspecialchars($row["price"]) . "<br>
                            <strong>Order Quantity:</strong> " . htmlspecialchars($row["order_quantity"]) . "<br>
                            <strong>Total Price:</strong> $" . htmlspecialchars($row["total_price"]) . "<br>
                            <strong>Order Date:</strong> " . htmlspecialchars($row["order_date"]) . "<br>
                            <strong>Status:</strong> " . htmlspecialchars($row["order_status"]) . "<br>
                            <a href='edit_order.php?id=" . htmlspecialchars($row["order_id"]) . "' class='btn btn-primary mt-2'>Edit</a>
                            <form action='delete_order.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='order_id' value='" . htmlspecialchars($row["order_id"]) . "'>
                                <button type='submit' class='btn btn-danger mt-2' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No orders found</p>";
        }
        ?>
    </div>

    <!-- Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
