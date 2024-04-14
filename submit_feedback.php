<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include 'db_connection.php';
    
    // Escape user inputs for security
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
    // Attempt to insert feedback into the database
    $sql = "INSERT INTO feedback_table (comment) VALUES ('$comment')";
    if (mysqli_query($conn, $sql)) {
        // Feedback successfully submitted
        echo "<script>alert('Thank you for your feedback!');</script>";
        echo "<script>window.location.href = 'main.html';</script>"; // Redirect to the homepage or any other page
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Close database connection
    mysqli_close($conn);
}
?>
