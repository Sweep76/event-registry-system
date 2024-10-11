<?php 
session_start();

$authenticated = false;
if (isset($_SESSION['email'])) {
    $authenticated = true;
}

if (!isset($_SESSION["email"])) {
    header("location: login.php");
    exit;
} 

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Best Store</title>
    <link rel="icon" href="images/globe.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .about-section {
            padding: 50px 0;
        }
        .about-header {
            color: #007bff; /* Primary blue color */
            text-align: center; /* Center align the headers */
            font-weight: bold; /* Make the header bold */
            margin-bottom: 20px; /* Space below headers */
        }
        .about-description {
            color: #495057; /* Darker gray for text */
            text-align: center; /* Center align the description */
            max-width: 800px; /* Limit width for better readability */
            margin: 0 auto 30px auto; /* Center it and add bottom margin */
        }
        .team-member {
            margin: 20px 0;
            background-color: #ffffff; /* White background for team member cards */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
        }
        .team-member:hover {
            transform: translateY(-5px);
            background-color: #f1f1f1; /* Slightly darker background on hover */
        }
        .team-photo {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            border: 5px solid #007bff; /* Primary blue border */
            margin-bottom: 15px;
        }
        /* Team Member Role Colors */
        .role-founder {
            color: #28a745; /* Green */
        }
        .role-manager {
            color: #ffc107; /* Yellow */
        }
        .role-developer {
            color: #dc3545; /* Red */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/globe.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Supplies Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="product_list.php">Product List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="orders.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="about_us.php">About us</a>
                        </li>
                    </ul>
                </ul>
                <?php
                if ($authenticated) { 
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User Tab
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

    <div class="container about-section">
        <h1 class="about-header">About Us</h1>
        <p class="about-description">Welcome to Whirl Business Enterprise, your number one source for all office supplies. We're dedicated to providing you the very best of products, with an emphasis on dependability, customer service, and uniqueness.</p>
        
        <h2 class="about-header">Our Mission</h2>
        <p class="about-description">Our mission is to supply businesses with the best tools and resources they need to thrive. We believe that quality office supplies enhance productivity and create a better working environment.</p>
        
        <h2 class="about-header">Our Team</h2>
        <p class="about-description">Meet the dedicated team behind Whirl Business Enterprise, committed to serving you!</p>
        
        <div class="row">
            <div class="col-md-4 team-member text-center">
                <img src="images/profile.png" alt="Team Member 1" class="team-photo mb-3">
                <h4>Luz G. Chiu</h4>
                <p class="role-founder">Founder & CEO</p>
                <p>Mrs. Luz has over 30 years of experience in the office supplies industry and is passionate about helping businesses succeed.</p>
            </div>
            <div class="col-md-4 team-member text-center">
                <img src="images/profile.png" alt="Team Member 2" class="team-photo mb-3">
                <h4>Patrick M. Chiu</h4>
                <p class="role-manager">Operations Manager</p>
                <p>Mr. Patrick ensures our operations run smoothly, providing exceptional service and support to our customers.</p>
            </div>
            <div class="col-md-4 team-member text-center">
                <img src="images/profile.png" alt="Team Member 3" class="team-photo mb-3">
                <h4>Joshua Chiu</h4>
                <p class="role-developer">Developer</p>
                <p>The guy who struggles in computer science.</p>
            </div>
        </div>

        <h2 class="about-header">Get in Touch</h2>
        <p class="about-description">If you have any questions or inquiries, feel free to <a href="contact.php">contact us</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
