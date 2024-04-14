<?php
// Include the database connection file
include 'db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the booking ID and new note from the POST data
    $bookingID = $_POST['bookingID']; // Use 'bookingID' instead of 'BookingID'
    $newNote = $_POST['note'];

    // Prepare and execute the SQL query to update the note for the specified booking ID
    $sql = "UPDATE itembookings SET Note = ? WHERE BookingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newNote, $bookingID);
    if ($stmt->execute()) {
        // If the query is successful, send a success response
        echo "Note updated successfully";
    } else {
        // If an error occurs, send an error response
        echo "Error updating note: " . $conn->error;
    }
} else {
    // If the request method is not POST, send an error response
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
