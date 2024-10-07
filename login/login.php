<?php
include "layout/header.php";

// check if the user is logged in, if yes then redirect him to the home page
if (isset($_SESSION["email"])) {
    header("Location: index.php");
    exit;
}

?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <hr />

        <!-- form action -->
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" value="" />
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" />
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="col d-grid">
                    <a href="index.php" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>                
        </form>
    </div>
</div>

<?php
include "layout/footer.php";
?>