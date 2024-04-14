<?php
// Include the database connection file
include 'db_connection.php';

// Start the session to access session variables
session_start();

// Check if the user is logged in and get their email
if(isset($_SESSION['email'])) {
    $loggedInEmail = $_SESSION['email'];
    $loggedInName = $_SESSION['name']; // Assuming 'name' is stored in session during login
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["itemName"];
    $quantity = $_POST["itemQuantity"];
    $bookingDate = $_POST["bookingDate"];
    $bookingTime = $_POST["bookingTime"];
    $note = $_POST["note"]; // Add the note field to the form data retrieval

    // Insert the booking information into the database, including the username and note
    $sql = "INSERT INTO ItemBookings (UserName, ItemName, Quantity, BookingDate, BookingTime, Note) VALUES ('$loggedInName', '$itemName', $quantity, '$bookingDate', '$bookingTime', '$note')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted ID (booking ID)
        $bookingID = $conn->insert_id;

        // Redirect to the booking receipt page with the booking ID
        header("Location: booking_receipt.php?bookingID=$bookingID");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
