<?php
session_start();
include 'header.php';

// Check if the user ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) { // Ensure it's non-empty
    $userId = $_GET['id']; // Do not convert to integer, as ID is a string (VARCHAR)

    // Fetch the user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['message'] = "User not found!";
        header("Location: users.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Invalid user ID!";
    header("Location: users.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roleType = $_POST['role_type'];
    $status = $_POST['status'];

    try {
        // Update the user in the database
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, role_type = :role_type, status = :status WHERE id = :id");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'role_type' => $roleType,
            'status' => $status,
            'id' => $userId, // Pass the original user ID
        ]);

        $_SESSION['message'] = "User updated successfully!";
        echo "<script>window.location.href='users.php';</script>";
        exit;
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error updating user: " . $e->getMessage();
        echo "<script>window.location.href='users.php';</script>";
        exit;
    
    }
}
?>

<!-- Page Header -->
<div class="container-fluid px-4">
    <h1 class="mt-4">Update User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="users.php">Users</a></li>
        <li class="breadcrumb-item active">Update User</li>
    </ol>

    <!-- Update User Form -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i> Update User Details
        </div>
        <div class="card-body">
            <form method="POST">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role_type" class="form-label">Role</label>
                    <select class="form-select" id="role_type" name="role_type" required>
                        <option value="Admin" <?= $user['role_type'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Moderator" <?= $user['role_type'] === 'Moderator' ? 'selected' : ''; ?>>Moderator</option>
                        <option value="User" <?= $user['role_type'] === 'User' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="active" <?= $user['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="pending" <?= $user['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="users.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
