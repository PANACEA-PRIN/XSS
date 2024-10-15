<?php

include 'db_config.php';

// Clear all comments from the database if a clear request is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clear all comments from the database
    $sql = "TRUNCATE TABLE Posts";
    $conn->query($sql);

    $dir = '/uploads';

    $files = glob($dir . '/*');

    // Itera su ciascun file e eliminalo
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    header("Location: /home");
}
// Close the db connection
$conn->close();
?>