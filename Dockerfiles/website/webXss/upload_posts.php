<?php
session_start();
// Include the database configuration file
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: /login");
    exit();
}
$username=  $_SESSION['username'];
// Save a new post to the database if a post form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment'])) {

        $comm = $_POST['comment']; // XSS VULN

        if (isset($_FILES['image'])){
        $imagePath =  'uploads/'.$_FILES['image']['name'];
        do{
            if (is_uploaded_file($_FILES['image']['tmp_name'])){

                // Get File information
                list($width, $height, $type, $attr) = getimagesize($_FILES['image']['tmp_name']);

                //  if (($width > 160) || ($height > 180)) {
                //  echo  "<p>Dimension are not rights</p>";
                //  }
            
                // Check this file name doesn't exists on server
                if (file_exists('uploads/'.$_FILES['image']['name'])) {
                echo "<p>File already exists.</p>";
                break;
                }

                // Move file in the uploads folder
                if (!move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$_FILES['image']['name'])) {
                    echo  "<p>Error on uploading image</p>";
                    break;
                }
            }
            break;
        }
        while(false);
        }
        $stmt = $conn->prepare("INSERT INTO Posts (`comment`, `imageUrl`, `username`) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $comm, $imagePath, $username);
        $stmt->execute();
    }

}

// Close the database connection
$conn->close();
?>
