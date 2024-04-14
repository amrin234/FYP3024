<?php
// Include the database connection file
include 'db_connection.php';

// Check if the item is selected
if(isset($_GET['item']) && !empty($_GET['item'])) {
    // Retrieve the selected item from the GET parameters
    $selectedItem = $_GET['item'];

    // Prepare and execute SQL query to fetch bookings for the selected item
    $sql = "SELECT BookingID, Username, ItemName, Quantity, BookingDate, BookingTime, Note FROM itembookings WHERE ItemName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedItem);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize an empty array to store bookings
    $bookings = [];

    // Fetch booking data and store it in the array
    while ($row = $result->fetch_assoc()) {
        $bookings[] = [
            'BookingID' => $row['BookingID'], // Include Booking ID
            'UserName' => $row['Username'],
            'ItemName' => $row['ItemName'],
            'Quantity' => $row['Quantity'],
            'BookingDate' => $row['BookingDate'],
            'BookingTime' => $row['BookingTime'],
            'Note' => $row['Note'] // Include the note column
        ];
    }

    // Convert the bookings array to JSON format and send it as the response
    echo json_encode($bookings);
} else {
    // If no item is selected, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
