<?php 
function getDatabaseConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "beststoredb";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);
    if($connection->connect_error) {
        die("Connection failed to connect to MySQL: " . $connection->connect_error);
    }

    return $connection;
}

?>