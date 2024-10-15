<?php
    // Start session
    session_start();
    include 'db_config.php';
    // Function to generate a random string
    function generateRandomString($length=10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

    // Check if a POST request has been sent
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the username and password fields are filled out
        if (isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {

            // Sanitize the input to prevent XSS and SQL injection attacks
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);

            // Query the database to check if the user exists
            $sql = "SELECT * FROM Users WHERE LOWER(username) = LOWER('$username') AND passw = '$password'";
            $result = $conn->query($sql);

            // If user doesn't exist, create a new user
            if ($result->num_rows == 0) {
                $sql ="SELECT EXISTS (SELECT 1 FROM Users WHERE username='$username') AS exist";
                $result =  $conn->query($sql);
                $row = $result->fetch_assoc();
                $userExists = $row['exist'];

                if (!$userExists){
                    $sql = "INSERT INTO Users (username, passw) VALUES ('$username', '$password')";
                    $result = $conn->query($sql);
                }
                else{
                    // UserExist but password is wrong
                    header("Location: /login");
                    $conn->close();
                    exit();
                }
            }

            // Set session username
            $_SESSION['username'] = $username;
/*
            if (isset($_COOKIE['cookie'])) {

                // Get Cookie value
                $cookieValue = $_COOKIE['cookie'];
            } else {
                // Set cookie
                $cookieValue = generateRandomString();
                setcookie('cookie', $cookieValue, time() + (86400 * 30), "/");

            }
            
            // Save cookie value in database
            $sql = "UPDATE Users SET cookie = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $cookieValue, $username);
            $stmt->execute();
  */          
            header("Location: /home");
            exit();
        } else {
            // If the field is empty, display an error message
            echo "Enter a username or password.";
        }
    }
    // Close the db connection
    $conn->close();
?>
