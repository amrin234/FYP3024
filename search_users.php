<?php
include 'db_connection.php';

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Query to search for users by name in the Users table
    $sql = "SELECT * FROM users WHERE name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    $users = array();

    if ($result->num_rows > 0) {
        // Fetching user details and adding them to the $users array
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    // Returning the users data as JSON
    echo json_encode($users);
} else {
    echo "No search term provided.";
}

$conn->close();
?>
