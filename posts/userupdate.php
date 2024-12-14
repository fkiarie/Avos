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

// Check if the form is submitted for updating the user data
if (isset($_POST['submit'])) {
    // Retrieve the data from the form
    $userID = $_GET['GetID'];  // Get the User ID from the URL parameter
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $tel = mysqli_real_escape_string($con, $_POST['tel']);
    $role_type = mysqli_real_escape_string($con, $_POST['role_type']);

    // Update query for the users table
    $query = "UPDATE users SET 
                name = '$name',
                username = '$username',
                email = '$email',
                tel = '$tel',
                role_type = '$role_type'
              WHERE id = '$userID'";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the update was successful
    if ($result) {
        header('Location: dashboard.php');  // Redirect to dashboard after successful update
        exit();
    } else {
        echo "Update Failed: " . mysqli_error($con); // Error message if the query fails
    }
} else {
    echo "No data to update";
}

// Close the database connection
mysqli_close($con);
?>
