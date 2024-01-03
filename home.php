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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];

    $sql = "SELECT * FROM hotels WHERE name LIKE '%$search%' OR location LIKE '%$search%'";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <p>Dream Stay With us.</p>
    <form method="post" action="">
        <label for="search">Search Hotels:</label>
        <input type="text" id="search" name="search" required>
        <input type="submit" value="Search">
    </form>
    <h3>Search Results:</h3>
    <?php
    if (isset($result) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['name']} - {$row['location']} <a href='booknow.php?id={$row['id']}'>Book Now</a></p>";
        }
    } else {
        echo "<p>No hotels found.</p>";
    }
    ?>
    <p><a href="mybooking.php">My Bookings</a></p> <!-- Button to navigate to mybooking.php -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
