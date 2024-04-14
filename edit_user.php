<?php
// Start PHP code block
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Panel</title>
    <link rel="stylesheet" href="viewUser.css">
</head>
<body>

    <header>
        <div class="logo-box">
            <img src="logo.png" alt="UPTM Logo" class="logo">
        </div>
        <h1>Edit User - Admin Panel</h1>
    </header>

    <div class="container">
        <h2>Edit User Details</h2>

        <?php
        include 'db_connection.php';

        if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            $sql = "SELECT * FROM users WHERE UserID = $userId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="update_process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['UserID']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required>
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $row['PhoneNumber']; ?>" required>
                    <label for="option">Faculty:</label>
                    <input type="text" id="option" name="option" value="<?php echo $row['Option']; ?>" required>
                    <label for="extension">Extension:</label>
                    <input type="text" id="extension" name="extension" value="<?php echo $row['Extension']; ?>" required>
                    <label for="registrationDate">Registration Date:</label>
                    <input type="text" id="registrationDate" name="registrationDate" value="<?php echo $row['RegistrationDate']; ?>" readonly>
                    <!-- Add Password Section -->
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Update</button>
                </form>
                <?php
            } else {
                echo "No result found for this ID.";
            }
        } else {
            echo "No user ID provided.";
        }

        $conn->close();
        ?>
    </div>

    <footer class="footer">
        <div class="col-2">
            <a href="admin_interface.html" class="view-feedback">Back to Admin Dashboard</a>
        </div>
    </footer>

</body>
</html>
<?php
// End PHP code block
?>