<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $option = $_POST['option'];
    $extension = $_POST['extension'];
    $password = $_POST['password']; // Added password field

    // Prepare SQL statement
    $sql = "UPDATE users SET Name='$name', Email='$email', PhoneNumber='$phone', Option='$option', Extension='$extension', Password='$password' WHERE UserID='$id'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>