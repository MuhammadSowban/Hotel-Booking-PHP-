<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Your database connection code
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ub.*, h.name AS hotel_name, h.location AS hotel_location 
        FROM user_bookings ub 
        INNER JOIN hotels h ON ub.hotel_id = h.id 
        WHERE ub.username = '$username'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
</head>
<body>
    <h2>My Bookings</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Hotel: {$row['hotel_name']}, {$row['hotel_location']} - Date: {$row['date']}, Check-in: {$row['checkin_time']}, Rooms: {$row['rooms']}, People: {$row['people']}</p>";
        }
    } else {
        echo "<p>No bookings found.</p>";
    }
    ?>
    <p><a href="home.php">Back to Home</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
