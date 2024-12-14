<?php 
// Database connection
$con = mysqli_connect("localhost", "root", "", "aeak");

// Check if 'GetID' parameter is passed in the URL
if (isset($_GET['GetID'])) {
    $userid = $_GET['GetID'];  // Get the ID from URL parameter

    // Sanitize the ID to prevent SQL injection
    $userid = mysqli_real_escape_string($con, $userid);

    // SQL query to update status to 'Active' for the user
    $qry = "UPDATE users SET status='Active' WHERE id='$userid'";

    // Execute the query
    $result = mysqli_query($con, $qry);

    // Check if the update was successful
    if ($result) {
        // Redirect to dashboard with a slight delay
        header('refresh:0.1;url=dashboard.php');
    } else {
        echo "Update Failed";
    }
}
?>
