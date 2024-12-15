<?php
session_start();
include 'auth_check.php';
include 'db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Check if user exists
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

// Redirect back to the users page
header("Location: users.php");
exit;
?>
