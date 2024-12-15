<?php
session_start();
include 'auth_check.php';
include 'db_connect.php';

// Check if the user ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id']; // Keep the ID as a string since it's a VARCHAR in the database

    // Check if the user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Delete the user
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $deleteStmt->execute(['id' => $userId]);

        $_SESSION['message'] = "User deleted successfully!";
    } else {
        $_SESSION['message'] = "User not found!";
    }
} else {
    $_SESSION['message'] = "Invalid user ID!";
}

echo "<script>window.location.href='users.php';</script>";
exit;
