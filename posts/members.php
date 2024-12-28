<?php
include 'header.php';

// Fetch summary data
try {
    $totalMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members")->fetchColumn();
    $activeMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members WHERE status = 'active'")->fetchColumn();
    $inactiveMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members WHERE status = 'inactive'")->fetchColumn();

    // Fetch detailed requests
    $stmt = $pdo->prepare("SELECT * FROM aeak_members ORDER BY submitted_at DESC");
    $stmt->execute();
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Membership Requests</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">View Requests</li>
    </ol>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header text-center">Total Members</div>
                <div class="card-body text-center fs-3"><?= $totalMembers; ?></div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header text-center">Active Members</div>
                <div class="card-body text-center fs-3"><?= $activeMembers; ?></div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-header text-center">Inactive Members</div>
                <div class="card-body text-center fs-3"><?= $inactiveMembers; ?></div>
            </div>
        </div>
    </div>

    <!-- Membership Requests Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Membership Requests
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Membership Type</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Membership Type</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['id']); ?></td>
                            <td><?= htmlspecialchars($request['name']); ?></td>
                            <td><?= htmlspecialchars($request['company']); ?></td>
                            <td><?= htmlspecialchars($request['email']); ?></td>
                            <td><?= htmlspecialchars($request['tel']); ?></td>
                            <td><?= htmlspecialchars($request['membership_type']); ?></td>
                            <td>
                                <span class="badge <?= $request['status'] === 'active' ? 'bg-success' : 'bg-danger'; ?>">
                                    <?= htmlspecialchars($request['status']); ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars(substr($request['message'], 0, 50)) . '...'; ?></td>
                            <td>
                                <a href="edit_request.php?id=<?= $request['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_request.php?id=<?= $request['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
