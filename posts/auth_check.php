<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not authenticated
    header("Location: login-form.php");
    exit;
}

// // Optionally, you can restrict access based on role type
// $allowedRoles = ['Admin', 'Moderator']; // Roles allowed to access this page
// if (!in_array($_SESSION['role_type'], $allowedRoles)) {
//     // Deny access if the user's role is not allowed
//     die("Access Denied: You do not have sufficient permissions to access this page.");
// }
?>
