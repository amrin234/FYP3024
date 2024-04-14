<?php
// Include the database connection file
include 'db_connection.php';

// Start the session to access session variables
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to fetch user data based on email
    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['Password'])) {
            // Password is correct, store the email and name in session variables
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user['Name']; // Assuming 'Name' is the column name in the users table

            if ($email === 'admin@gmail.com' && $password === '123') {
                // Redirect admin to admin_interface.html
                header("Location: admin_interface.html");
                exit();
            } else {
                // Redirect regular user to main.html or dashboard
                header("Location: main.html");
                exit();
            }
        } else {
            // Password is incorrect
            header("Location: login.html?error=Incorrect Password");
            exit();
        }
    } else {
        // User with the given email does not exist
        header("Location: login.html?error=Email does not exist");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
