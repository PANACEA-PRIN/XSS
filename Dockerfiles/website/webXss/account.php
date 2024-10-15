<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header("Location: /login");
    exit();
}
include 'db_config.php';

// Retrieve the username from the session
$username = $_SESSION['username'];

// Query to select all comments made by the logged-in user
$sql = "SELECT comment FROM Posts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .comments {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .comment {
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account</h1>
        <p>Username: <?php echo htmlspecialchars($username); ?></p>
        <h2>Your Comments</h2>
        <div class="comments">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="comment">' . htmlspecialchars($row['comment']) . '</div>';
                }
            } else {
                echo '<p>No comments found.</p>';
            }
            ?>
        </div>
        <form action="/info" method="get" style="margin-top: 20px;">
            <button type="submit">Show Sensitive Data</button>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
