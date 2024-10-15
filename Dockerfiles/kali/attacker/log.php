<?php

// Read data from the URL
$data = $_GET['data'];

// Save the data to the log file
file_put_contents('log.txt', $data . "\n", FILE_APPEND);

// Return a confirmation message
echo "Data logged";

?>


