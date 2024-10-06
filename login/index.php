<?php 
// initialize the session
session_start();

$authenticated = false;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Best Store</title>
    <link rel="icon" href="images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>


  <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Best Store
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-dark" href="index.php">Home</a>
          </li>
          
        </ul>
        <?php
        if ($authenticated) { 
        ?>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Client
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
          </li>
        </ul>

        <?php
        } else {
        ?>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="register.php" class="btn btn-outline-primary me-2">Register</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="btn btn-primary">Login</a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>


  <div style="background-color: #08618d;">
  <div class="container text-white py-5">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1 class="mb-5 display-2"><strong>Best Shop of Electronics</strong></h1>
        <p>
          Find a large selection of newest electronic devices from most popular brands and with affordable prices.
        </p>
      </div>
      <div class="col-md-6">
        <img src="images/phone.png" class="img-fluid" alt="hero" style="max-width: 70%;"/> <!-- Set max-width -->
      </div>
    </div>
  </div>
</div>



  <footer class = "py-5" style="background-color: #eef0f2">
    <div class="container">
      <div class="row">
          <div class="col text-center">
            <img class="mb-4" src="images/logo.png" alt="" width="24" height="24">
            <small class="d-block text-muted">&copy; 2017-<?= date("Y") ?></small>
          </div>
      </div>
    </div>
  </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

</html>