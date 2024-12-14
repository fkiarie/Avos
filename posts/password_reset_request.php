<!DOCTYPE html>
<html lang="en">





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="css/dash.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">Dashboard</div>
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li><a href="#"><i class="fa fa-blog"></i> Manage Blogs</a></li>
                    <li><a href="password_reset_request.php"><i class="fa fa-cogs"></i> Password Reset</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header>

                <h1>User Management</h1>
                
                <div class="floating-search-container">
        <form action="search.php" method="POST" class="floating-search-form">
            <input type="text" name="search" class="floating-search-input" placeholder="Search">
            <button type="submit" name="submit" class="floating-search-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>


            <?php
        session_start(); // Start the session

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if not logged in
            header("Location: login-form.php");
            exit();
        }

        echo "Welcome, " . $_SESSION['user_name']; // You can now access the session variables
        ?>

        <a href="register-form.php"> <button class="btn-primary">+ Add User</button> </a>

                
            </header>    

            <section class="content-table">
    <!-- Overlay background (optional) -->
<div class="overlay"></div>

<!-- Reset form container -->
<div class="reset-container">
    <h2>Request Password Reset</h2>
    <form method="POST" action="password_reset_request.php">
        <label for="username_or_email">Username or Email:</label>
        <input type="text" name="username_or_email" required>
        <button type="submit" name="submit">Request Reset</button>
    </form>
</div>

<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "aeak");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username_or_email = mysqli_real_escape_string($con, $_POST['username_or_email']);

    // Check if the input is email or username and search for it
    if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
        // Search by email
        $query = "SELECT * FROM users WHERE email = '$username_or_email'";
    } else {
        // Search by username
        $query = "SELECT * FROM users WHERE username = '$username_or_email'";
    }

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));
        
        // Get the user's data
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        $email = $row['email'];

        // Store the token in the database with expiration time (1 hour)
        $expiry_time = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $update_query = "UPDATE users SET reset_token = '$token', reset_token_expiry = '$expiry_time' WHERE id = '$user_id'";
        mysqli_query($con, $update_query);

        // Send password reset email
        $reset_link = "http://yourwebsite.com/password_reset.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password: \n" . $reset_link;
        $headers = "From: noreply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Error sending email. Please try again.";
        }
    } else {
        echo "No account found with that username or email.";
    }
}

mysqli_close($con);
?>

                    </section>
                </main>
            </div>
            <script src="script.js">
            document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll(".btn-delete");

            deleteButtons.forEach(button => {
                button.addEventListener("click", () => {
                    if (confirm("Are you sure you want to delete this user?")) {
                        // Perform deletion logic here (e.g., send request to backend)
                        console.log("User deleted.");
                    }
                });
            });
        });
        </script>


</body>
</html>