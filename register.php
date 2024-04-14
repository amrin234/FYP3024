<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password']; // Added password field
    $option = $_POST['option'];
    $extension = isset($_POST['extension']) ? $_POST['extension'] : null; // Check if extension is set

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to insert data into the Users table
    $sql = "INSERT INTO users (Name, Email, PhoneNumber, Password, Option, Extension) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssss", $name, $email, $phone, $hashed_password, $option, $extension);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Redirect back to the registration page with success message
    header("Location: register.html?success=Register%20Successfully");
    exit();
}
?>
