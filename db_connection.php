<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "uptm_it_booking_system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
