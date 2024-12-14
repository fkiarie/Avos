<?php
// Database connection
$servername = "localhost"; // Replace with your database host
$username = "kentours"; // Replace with your database username
$password = "Team.1234"; // Replace with your database password
$dbname = "aeak"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate the primary key in AEAK### format
function generateUserId($conn) {
    $query = "SELECT IFNULL(MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)), 0) + 1 AS next_id FROM users";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $nextId = $row['next_id'];
        return "AEAK" . str_pad($nextId, 3, "0", STR_PAD_LEFT);
    } else {
        die("Error generating user ID: " . $conn->error);
    }
}

// Initialize variables
$message = "";
$isSuccess = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $tel = htmlspecialchars(trim($_POST['tel']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));
    $role_type = htmlspecialchars(trim($_POST['role_type']));

    // Validate required fields
    if (empty($name) || empty($username) || empty($email) || empty($tel) || empty($password) || empty($confirmPassword) || empty($role_type)) {
        $message = "All fields are required.";
    } elseif (!$email) {
        $message = "Invalid email address.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)) {
        $message = "Password must be at least 8 characters long, contain at least one uppercase letter, and one number.";
    } else {
        // Check if the username already exists in the database
        $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkUsernameQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = "Username is already taken, please choose another one.";
        } else {
            // Check if the email already exists in the database
            $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($checkEmailQuery);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $message = "Email is already registered, please use another email address.";
            } else {
                // Hash the password for security
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Generate the primary key
                $userId = generateUserId($conn);

                // Insert data securely using prepared statements
                $stmt = $conn->prepare("INSERT INTO users (id, name, username, email, tel, pass, role_type, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                if ($stmt) {
                    $stmt->bind_param("sssssss", $userId, $name, $username, $email, $tel, $hashedPassword, $role_type);

                    if ($stmt->execute()) {
                        $message = "User registered successfully with ID: $userId.";
                        $isSuccess = true;
                    } else {
                        $message = "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $message = "Error preparing statement: " . $conn->error;
                }
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
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
        <a href="register-form.php">Go Back to Registration</a>
    </div>
</body>
</html>
