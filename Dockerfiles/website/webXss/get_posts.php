<?php
include 'db_config.php';

try {
    $sql = "SELECT comment, imageUrl,username FROM Posts";
    $result =  $conn->query($sql);
   

    if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $posts[] = (object) $row;
    }
}
    header('Content-Type: application/json');
    echo json_encode($posts);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
// Close the db connection
$conn->close();
?>
