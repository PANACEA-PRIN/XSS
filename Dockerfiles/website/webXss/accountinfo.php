<?php
session_start();
header('Content-Type: application/javascript');

// Include the database configuration
include 'db_config.php';

// Check if the user is logged in and the username is stored in the session
if (!isset($_COOKIE['PHPSESSID']))
 { 
    http_response_code(403);
    echo "Access denied";
    exit;
}

$username = $_SESSION['username'];

// Query to select the username and password
$sql = "SELECT username, passw FROM Users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    http_response_code(404);
    echo "User not found";
    exit;
}



// Prepare the data
$data = array(
    'username' => $user['username'],
    'password' => $user['passw']
);

$response = "(" . json_encode($data) . ");";
echo $response;
?>
