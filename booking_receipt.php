<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    text-align: center;
}

header {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #333;
    color: #fff;
    padding: 1em 20px;
}

h1 {
    margin: 0;
    text-align: center;
}


.logo-box {
    display: flex;
    align-items: center;
    background-color: #fff; /* White background color for the logo container */
    padding: 10px; /* Adjust padding as needed */
    border-radius: 8px; /* Optional: Add border-radius for rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle box shadow */
}

.logo {
    max-width: 100px;
    margin-bottom: 10px; /* Add some margin between the logo and the title */
}


#booking-section {
    max-width: 600px;
    margin: 2em auto;
    padding: 2em;
    background-color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1,
h2,
p,
label {
    color: #fff;
}

select,
input {
    color: #333;
}

form {
    margin-top: 2em;
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    display: block;
    margin-bottom: 0.5em;
}

select,
input {
    width: 100%;
    max-width: 400px;
    padding: 0.5em;
    margin-bottom: 1em;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background-color: #333;
    color: #fff;
    padding: 0.8em 1.5em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}

        .receipt {
            max-width: 600px;
            margin: 2em auto;
            padding: 2em;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1em;
        }

        strong {
            color: #333;
        }

        * {
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}

.footer {
    margin-top: 150px;
    width: 100%;
    padding: 100px 15%;
    background: #333;
    color: #fff;
    display: flex;
}

.footer div {
    text-align: center;
}

.col-2 {
    flex-grow: 2;
}

.footer div h3 {
    font-weight: 300;
    margin-bottom: 30px;
    letter-spacing: 1px;
}

.col-1 a {
    display: block;
    text-decoration: none;
    color: #fff;
    margin-bottom: 10px;
}

form input {
    width: 100%;
    max-width: 400px;
    height: 45px;
    border-radius: 4px;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    outline: none;
    border: none;
}

form button {
    background: transparent;
    border: 2px solid #fff;
    color: #fff;
    border-radius: 30px;
    padding: 10px 30px;
    font-size: 15px;
    cursor: pointer;
}
    </style>
</head>

<body>

<header>
        <div class="logo-box">
            <img src="logo.png" alt="UPTM Logo" class="logo"> <!-- Add your logo here -->
        </div>
        <h1>UPTM IT Booking System</h1>
    </header>

    <div class="receipt">
        <h2>Booking Receipt</h2>
        <?php
        if (isset($_GET["bookingID"])) {
            $bookingID = $_GET["bookingID"];

            // Establish a connection to the MySQL database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "UPTM_IT_Booking_System";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM ItemBookings WHERE BookingID = $bookingID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Display the booking details in a receipt format
                echo "<p><strong>Booking ID:</strong> {$row['BookingID']}</p>
                      <p><strong>Item Name:</strong> {$row['ItemName']}</p>
                      <p><strong>Quantity:</strong> {$row['Quantity']}</p>
                      <p><strong>Booking Date:</strong> {$row['BookingDate']}</p>
                      <p><strong>Booking Time:</strong> {$row['BookingTime']}</p>
                      <p><strong>Timestamp:</strong> {$row['Timestamp']}</p>";
            } else {
                echo "<p>Error: No records found for Booking ID: $bookingID</p>";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "<p>Error: No Booking ID received</p>";
        }
        ?>
    </div>

    <div class="footer">
        <div class="col-1">
            <h3>USEFUL LINKS</h3>
            <a href="https://www.uptm.edu.my/index.php/about-us">About Us</a>
            <a href="Faq.pdf">How To Use</a>
        </div>
        <div class="col-2">
            <form>
                <input type="text" placeholder="Your Comment" required>
                <br>
                <button type="submit">SUBMIT YOUR FEEDBACK</button>
            </form>
        </div>
        <div class="col-3">
            <h3>Contact</h3>
            <p>AMIN , 018-571 0391</p>
        </div>
    </div>

</body>

</html>
