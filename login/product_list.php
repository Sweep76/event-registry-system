<?php 
include "layout/header.php"; 

// Check if the user is logged in
if(!isset($_SESSION["email"])){
    header("location: login.php");
    exit;
} 

include "tools/db.php";
$dbConnection = getDatabaseConnection();

// Set the number of results per page
$results_per_page = 10;

// Check if the page is set, otherwise default to page 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the query
$offset = ($page - 1) * $results_per_page;

// Prepare the SQL statement to select products with limit and offset
$statement = $dbConnection->prepare("SELECT id, name, description, price, quantity FROM products LIMIT ? OFFSET ?");
$statement->bind_param("ii", $results_per_page, $offset);
$statement->execute();
$result = $statement->get_result(); // Fetch the results

// Get the total number of products for pagination
$total_products_statement = $dbConnection->prepare("SELECT COUNT(id) AS total FROM products");
$total_products_statement->execute();
$total_products_result = $total_products_statement->get_result();
$total_products = $total_products_result->fetch_assoc()['total'];

// Calculate the total number of pages
$total_pages = ceil($total_products / $results_per_page);
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
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .page-link {
            margin: 0 5px;
        }

        /* CSS for smooth transition */
        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in.show {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="table-container fade-in">
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

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a class="btn btn-outline-primary page-link" href="product_list.php?page=<?php echo $page-1; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a class="btn btn-primary page-link <?php if($i == $page) echo 'active'; ?>" href="product_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a class="btn btn-outline-primary page-link" href="product_list.php?page=<?php echo $page+1; ?>">Next</a>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to trigger the fade-in animation after page load -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableContainer = document.querySelector('.table-container');
        tableContainer.classList.add('show');
    });
</script>

</body>
</html>

<?php include "layout/footer.php"; ?>
