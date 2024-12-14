<?php
// Start the session
session_start();

// Check if the token exists
if (!isset($_GET['token'])) {
    die("Invalid request.");
}

// Database connection
$con = mysqli_connect("localhost", "root", "", "aeak");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the token from the URL
$token = mysqli_real_escape_string($con, $_GET['token']);

// Check if the token exists and is valid (not expired)
$query = "SELECT * FROM users WHERE reset_token = '$token' AND reset_token_expiry > NOW()";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // Token is valid
    if (isset($_POST['reset_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate password
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the user's password in the database
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            // Update password and reset token fields
            $update_query = "UPDATE users SET pass = '$hashedPassword', reset_token = NULL, reset_token_expiry = NULL WHERE id = '$user_id'";
            if (mysqli_query($con, $update_query)) {
                echo "Password updated successfully. You can now <a href='login.php'>login</a> with your new password.";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "Passwords do not match.";
        }
    }
} else {
    echo "Invalid or expired reset link.";
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <form method="POST" action="password_reset.php?token=<?php echo $token; ?>">
        <label>New Password:</label>
        <input type="password" name="new_password" required><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
</body>
</html>
