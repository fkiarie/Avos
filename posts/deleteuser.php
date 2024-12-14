<?php
// Database connection
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "aeak"; // Replace with your database name

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user ID is provided in the URL
if (isset($_GET['GetID'])) {
    // Get the user ID from the URL parameter
    $userID = $_GET['GetID'];

    // SQL query to delete the user based on the user ID
    $query = "DELETE FROM users WHERE id = '$userID'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Redirect to the user list page after deletion
        header('Location: dashboard.php');
        exit(); // Make sure the script stops after the redirect
    } else {
        echo "Error: " . mysqli_error($con); // Error message if deletion fails
    }
} else {
    echo "User ID not provided!";
}

// Close the database connection
mysqli_close($con);
?>
