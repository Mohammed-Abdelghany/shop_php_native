<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ecommerce";
$port="3307";

// Connection
$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname,
    $port
);

// Check if connection is 
// Successful or not
if (!$conn) {
    die("Connection failed: "
        . mysqli_connect_error());
}

?>