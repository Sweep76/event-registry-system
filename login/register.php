<?php include "layout/header.php";
// include "../tools/validator.php";

// logged in users are redirected to the home page
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

$first_name_error = "";
$last_name_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // validate first_name
    if (empty($first_name)) {
        $first_name_error = "First name is required";
        $error = true;
    }

    // validate last_name
    if (empty($last_name)) {
        $last_name_error = "Last name is required";
        $error = true;
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $error = true;
    }

    include "./tools/db.php";
    $dbConnection = getDatabaseConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");

    // Bind a variable to the prepared statement as parameters
    $statement->bind_param("s",$email);

    //execute statement
    $statement->execute();

    // check if email is already in the database
    $statement->store_result();
    if ($statement->num_rows > 0){
        $email_error = "Email is already used";
        $error = true;
    }

    // close this statement otherwise we cannot prepare another statement
    $statement->close();



    // validate phone
    if (!preg_match("/^(\+|00\d{1,3})?[- ]?\d{7,12}$/", $phone)) {
        $phone_error = "Invalid phone number";
        $error = true;
    }

    // validate password
    if (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters";
        $error = true;
    }

    // validate confirm_password
    if ($password != $confirm_password) {
        $confirm_password_error = "Passwords do not match";
        $error = true;
    }



    if (!$error) {
        // All fields are valid: create a new user
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        //Let use prepared statements to avoid "sql injection attacks"
        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at) " . "VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        // Bind variables to the prepared statement as parameters
        $statement->bind_param('sssssss', $first_name, $last_name, $email, $phone, $address, $password, $created_at);

        // execute statement
        $statement->execute();

        $insert_id = $statement->insert_id;
        $statement->close();


        // Save session data
        $_SESSION['id'] = $insert_id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
        $_SESSION['created_at'] = $created_at;

        // Redirect to the home page
        header("Location: index.php");
        exit;
    }
}

?>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
           <h2 class="text-center mb-4">Register</h2> 
            <hr />


            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?= $first_name; ?>">
                        <span class="text-danger"><?= $first_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?= $last_name; ?>">
                        <span class="text-danger"><?= $last_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?= $email; ?>">
                        <span class="text-danger"><?= $email_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?= $phone; ?>">
                        <span class="text-danger"><?= $phone_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?= $address; ?>">
                        <span class="text-danger"><?= $address_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="password">
                        <span class="text-danger"><?= $password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="confirm_password">
                        <span class="text-danger"><?= $confirm_password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="index.php" class="btn btn-outline-primary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php"; ?>