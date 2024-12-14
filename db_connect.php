
<?php
$host = 'localhost';    // Hostname
$dbname = 'aeak';       // Database name
$user = 'kentours';         // Database username
$password = 'Team.1234';         // Database password

try {
    // Connect to MySQL using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

