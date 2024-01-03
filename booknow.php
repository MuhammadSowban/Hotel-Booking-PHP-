<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$hotel_id = $hotel_name = $hotel_location = '';

// Assuming the hotel_id is provided via GET parameter 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Your database connection code
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mydb";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $hotel_id = $_GET['id'];
    $sql = "SELECT * FROM hotels WHERE id = $hotel_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hotel_name = $row['name'];
        $hotel_location = $row['location'];
    } else {
        echo "Hotel not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for booking
    $date = $_POST['date'];
    $checkin_time = $_POST['checkin_time'];
    $rooms = $_POST['rooms'];
    $people = $_POST['people'];

    // Retrieve hotel_id from the form submission
    $hotel_id = $_POST['hotel_id'];
     $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "mydb";

    // Insert booking details into the database for the user
    // Replace this with your database connection and insertion code
    // Establish your connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Adjust SQL query to use hotel name and location variables, and remove unnecessary single quotes
    $sql = "INSERT INTO user_bookings (username, name, location, date, checkin_time, rooms, people, hotel_id)
            VALUES ('$username', '$hotel_name', '$hotel_location', '$date', '$checkin_time', '$rooms', '$people', $hotel_id)";

    if ($conn->query($sql) === TRUE) {
        header('Location: mybooking.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Now</title>
</head>
<body>
    <h2>Book Now - <?php echo $hotel_name; ?>, <?php echo $hotel_location; ?></h2>
    <form method="post" action="">
        <!-- Add a hidden input field to hold the hotel_id -->
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="checkin_time">Check-in Time:</label>
        <input type="text" id="checkin_time" name="checkin_time" required><br><br>
        <label for="rooms">Rooms:</label>
        <input type="number" id="rooms" name="rooms" required><br><br>
        <label for="people">Number of People:</label>
        <input type="number" id="people" name="people" required><br><br>
        <input type="submit" value="Book">
    </form>
    <p><a href="home.php">Back to Home</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
