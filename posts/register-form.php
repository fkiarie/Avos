<?php
session_start();
include 'header.php'; // Includes navigation and database connection

// Restrict access to admin role only
if ($_SESSION['role_type'] !== 'Admin') {
    $_SESSION['message'] = "Access denied. Admins only!";
    header("Location: dashboard.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = uniqid('AEAK');
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $roleType = $_POST['role_type'];
    $status = 'pending'; // Default status
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    try {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (id, name, username, email, tel, role_type, pass, status) VALUES (:id, :name, :username, :email, :tel, :role_type, :pass, :status)");
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'tel' => $tel,
            'role_type' => $roleType,
            'pass' => $password,
            'status' => $status,
        ]);

        $_SESSION['message'] = "User registered successfully!";
        echo "<script>window.location.href='users.php';</script>";
        exit;
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Register User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="users.php">Users</a></li>
        <li class="breadcrumb-item active">Register User</li>
    </ol>

    <!-- Registration Form -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-plus me-1"></i> Register New User
        </div>
        <div class="card-body">
            <form method="POST">
                <!-- Name -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Username -->
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>

                <!-- Email & Telephone -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tel" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="tel" name="tel" required>
                    </div>
                </div>

                <!-- Role & Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="role_type" class="form-label">Role</label>
                        <select class="form-select" id="role_type" name="role_type" required>
                            <option value="Admin">Admin</option>
                            <option value="Moderator">Moderator</option>
                            <option value="User">User</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <a href="users.php" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Register User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
