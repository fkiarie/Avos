<?php
include 'header.php';

// Fetch summary data
try {
    // Posts
    $totalPosts = $pdo->query("SELECT COUNT(*) FROM member_updates")->fetchColumn();
    $publishedPosts = $pdo->query("SELECT COUNT(*) FROM member_updates WHERE status = 'published'")->fetchColumn();
    $draftPosts = $pdo->query("SELECT COUNT(*) FROM member_updates WHERE status = 'draft'")->fetchColumn();

    // Members
    $totalMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members")->fetchColumn();
    $activeMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members WHERE status = 'active'")->fetchColumn();
    $inactiveMembers = $pdo->query("SELECT COUNT(*) FROM aeak_members WHERE status = 'inactive'")->fetchColumn();

    // Users
    $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $adminUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE role_type = 'Admin'")->fetchColumn();
    $moderatorUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE role_type = 'Moderator'")->fetchColumn();
} catch (PDOException $e) {
    die("Error fetching summary data: " . $e->getMessage());
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Posts Summary -->
    <h2 class="mb-3">Posts Summary</h2>
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header text-center">Total Posts</div>
                <div class="card-body text-center fs-3"><?= $totalPosts; ?></div>
                <div class="card-footer text-center">
                    <a href="posts.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header text-center">Published Posts</div>
                <div class="card-body text-center fs-3"><?= $publishedPosts; ?></div>
                <div class="card-footer text-center">
                    <a href="posts.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-header text-center">Draft Posts</div>
                <div class="card-body text-center fs-3"><?= $draftPosts; ?></div>
                <div class="card-footer text-center">
                    <a href="posts.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Members Summary -->
    <h2 class="mb-3">Members Summary</h2>
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header text-center">Total Members</div>
                <div class="card-body text-center fs-3"><?= $totalMembers; ?></div>
                <div class="card-footer text-center">
                    <a href="members.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header text-center">Active Members</div>
                <div class="card-body text-center fs-3"><?= $activeMembers; ?></div>
                <div class="card-footer text-center">
                    <a href="members.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-header text-center">Inactive Members</div>
                <div class="card-body text-center fs-3"><?= $inactiveMembers; ?></div>
                <div class="card-footer text-center">
                    <a href="members.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Summary -->
    <h2 class="mb-3">Users Summary</h2>
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header text-center">Total Users</div>
                <div class="card-body text-center fs-3"><?= $totalUsers; ?></div>
                <div class="card-footer text-center">
                    <a href="users.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header text-center">Admins</div>
                <div class="card-body text-center fs-3"><?= $adminUsers; ?></div>
                <div class="card-footer text-center">
                    <a href="users.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-header text-center">Moderators</div>
                <div class="card-body text-center fs-3"><?= $moderatorUsers; ?></div>
                <div class="card-footer text-center">
                    <a href="users.php" class="text-white">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
