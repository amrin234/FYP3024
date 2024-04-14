<?php
// Include database connection file
include_once "db_connection.php";

// Fetch feedback records from database
$sql = "SELECT id, date, comment FROM feedback_table";
$result = mysqli_query($conn, $sql);

$feedbackData = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each feedback entry to the feedbackData array
        $feedbackData[] = array(
            'id' => $row['id'],
            'date' => $row['date'],
            'comment' => $row['comment']
        );
    }
}

// Close database connection
mysqli_close($conn);

// Return feedback data as JSON
echo json_encode($feedbackData);
?>
