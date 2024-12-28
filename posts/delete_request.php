<?php
include 'header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Invalid request ID.";
    echo "<script>window.location.href='members.php';</script>";
    exit;
}

$requestId = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM aeak_members WHERE id = :id");
    $stmt->execute(['id' => $requestId]);

    $_SESSION['message'] = "Request deleted successfully!";
    echo "<script>window.location.href='members.php';</script>";
    exit;
} catch (PDOException $e) {
    die("Error deleting request: " . $e->getMessage());
}
