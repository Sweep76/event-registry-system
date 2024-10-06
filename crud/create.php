<?php
    include 'db_connection.php';

    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        do {
            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                $errorMessage = "All fields are required";
                break;
            }

            // add new client to database
            $sql = "INSERT INTO clients (name, email, phone, address) " . "VALUES ('$name', '$email', '$phone', '$address')";
            $results = $connection->query($sql);

            if (!$results) {
                $errorMessage = "Invalid Query: " . $connection->error;
                break;
            }

            $name = "";
            $email = "";
            $phone = "";
            $address = "";

            $successMessage = "Client added successfully";


            header("location: /test/event-registry-system/crud/index.php");
            exit;

        } while (false);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>event-registry-system</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>

        <?php 
        if( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <stong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method = "post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php 
                if (!empty($successMessage)) {
                    echo "
                    <div class='rob mb-3'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <stong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                    ";
                }
            ?>

            <div class="row mb-3">
                <div class="col-sm-3 col-sm-3 d-grind">
                    <button type="submit" class="btn btn-primary" href = "/test/event-registry-system/crud/index.php">Submit</button>
                </div>

                <div class="col-sm-3 col-sm-3 d-grind">
                    <a class="btn btn-outline-primary" href="/test/event-registry-system/crud/index.php" role="button">Cancel</a>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>