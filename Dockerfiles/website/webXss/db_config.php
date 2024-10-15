<?php
// Database configuration
$servername = "192.168.2.20"; // Modify in case of using Kathara
$username = "root"; // Enter your username
$password = ""; // Enter your password
$dbname = "db_web"; // Enter your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
