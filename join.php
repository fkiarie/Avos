<?php
session_start();
include 'db_connect.php';

// Ensure CSRF token matches
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token.");
}

// Validate form data
$name = htmlspecialchars($_POST['name']);
$company = htmlspecialchars($_POST['company']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$tel = htmlspecialchars($_POST['tel']);
$membership_type = htmlspecialchars($_POST['membership_type']);
$message = htmlspecialchars($_POST['message']);

if (!$email) {
    die("Invalid email address.");
}

try {
    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO aeak_members (name, company, email, tel, membership_type, message, submitted_at) VALUES (:name, :company, :email, :tel, :membership_type, :message, NOW())");
    $stmt->execute([
        'name' => $name,
        'company' => $company,
        'email' => $email,
        'tel' => $tel,
        'membership_type' => $membership_type,
        'message' => $message,
    ]);

    echo "<script>alert('Your application has been submitted successfully.'); window.location.href = 'join-form.php';</script>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
