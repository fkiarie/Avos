<?php
// Start the session
session_start();
include 'config.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Initialize message and success flag
$message = "";
$isSuccess = false;

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Sanitize and validate inputs to prevent SQL Injection
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $enteredPassword = $_POST['pass']; // Password entered by user

    // Validate inputs
    if (empty($email) || empty($enteredPassword)) {
        $message = "Please fill in both fields.";
    } else {
        // Query to fetch user by email
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);

            // Check if the status is 'Active'
            if ($row['status'] !== 'Active') {
                $message = "Your account is not active. Please contact the admin for assistance.";
            } else {
                // Verify the hashed password using password_verify()
                if (password_verify($enteredPassword, $row['pass'])) {
                    // Password is correct, set session variables and redirect to dashboard
                    $_SESSION['user_id'] = $row['id']; // Store user ID in session for future use
                    $_SESSION['user_name'] = $row['name']; // Store user name in session

                    // Redirect to the dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Incorrect password
                    $message = "Incorrect password. Please try again.";
                }
            }
        } else {
            // User not found
            $message = "No account found with that email address.";
        }
    }
} else {
    $message = "No data posted.";
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            max-width: 500px;
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .message-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: <?php echo $isSuccess ? "#28a745" : "#dc3545"; ?>;
        }
        .message-container p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .message-container a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .message-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1><?php echo $isSuccess ? "Success!" : "Error!"; ?></h1>
        <p><?php echo $message; ?></p>
        <a href="login-form.php">Back to Login</a>
    </div>
</body>
</html>
