<?php
// Innitialize session
session_start();

// unset all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the home page
header("Location: index.php");
?>