<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: login.php');
exit;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h2>You have been logged out</h2>
    <p><a href="login.php">Click here</a> to log in again.</p>
</body>
</html>
