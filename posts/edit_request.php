<?php
include 'header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Invalid request ID.";
    header("Location: view_requests.php");
    exit;
}

$requestId = intval($_GET['id']);

// Fetch existing member data
$stmt = $pdo->prepare("SELECT * FROM aeak_members WHERE id = :id");
$stmt->execute(['id' => $requestId]);
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    $_SESSION['message'] = "Request not found.";
    header("Location: view_requests.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $membership_type = $_POST['membership_type'];
    $message = $_POST['message'];
    $status = $_POST['status']; // New status field

    try {
        $stmt = $pdo->prepare("UPDATE aeak_members 
            SET name = :name, company = :company, email = :email, tel = :tel, 
                membership_type = :membership_type, message = :message, status = :status 
            WHERE id = :id");
        $stmt->execute([
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'tel' => $tel,
            'membership_type' => $membership_type,
            'message' => $message,
            'status' => $status,
            'id' => $requestId,
        ]);

        $_SESSION['message'] = "Request updated successfully!";
        echo "<script>window.location.href='members.php';</script>";
        exit;
    } catch (PDOException $e) {
        die("Error updating request: " . $e->getMessage());
    }
}
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Membership Request</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="members.php">Membership Requests</a></li>
        <li class="breadcrumb-item active">Edit Request</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i> Edit Request
        </div>
        <div class="card-body">
            <form method="POST">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($request['name']); ?>" required>
                </div>

                <!-- Company -->
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?= htmlspecialchars($request['company']); ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($request['email']); ?>" required>
                </div>

                <!-- Telephone -->
                <div class="mb-3">
                    <label for="tel" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="tel" name="tel" value="<?= htmlspecialchars($request['tel']); ?>" required>
                </div>

                <!-- Membership Type -->
                <div class="mb-3">
                    <label for="membership_type" class="form-label">Membership Type</label>
                    <select class="form-select" id="membership_type" name="membership_type" required>
                        <option value="Premium" <?= $request['membership_type'] === 'Premium' ? 'selected' : ''; ?>>Premium</option>
                        <option value="Standard" <?= $request['membership_type'] === 'Standard' ? 'selected' : ''; ?>>Standard</option>
                    </select>
                </div>

                <!-- Message -->
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required><?= htmlspecialchars($request['message']); ?></textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="inactive" <?= $request['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                        <option value="active" <?= $request['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="view_requests.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>