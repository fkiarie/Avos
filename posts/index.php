<?php

include 'auth_check.php';
include 'header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>

    <?php
    // Fetch counts from the database
    try {
        // Total posts
        $totalPosts = $pdo->query("SELECT COUNT(*) FROM member_updates")->fetchColumn();

        // Draft posts
        $pendingPosts = $pdo->query("SELECT COUNT(*) FROM member_updates WHERE status = 'draft'")->fetchColumn();

        // Published posts
        $publishedPosts = $pdo->query("SELECT COUNT(*) FROM member_updates WHERE status = 'published'")->fetchColumn();
    } catch (PDOException $e) {
        // Handle errors gracefully
        $totalPosts = $pendingPosts = $publishedPosts = 0;
        echo "Error fetching data: " . $e->getMessage();
    }
    ?>

    <div class="row">
        <!-- Total Posts Card -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header text-lg-center">Total Posts</div>
                <div class="card-body fs-1 text-lg-center"><?= $totalPosts; ?></div>
            </div>
        </div>

        <!-- Draft Posts Card -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-header text-lg-center">Draft Posts</div>
                <div class="card-body fs-1 text-lg-center"><?= $pendingPosts; ?></div>
            </div>
        </div>

        <!-- Published Posts Card -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header text-lg-center">Published Posts</div>
                <div class="card-body fs-1 text-lg-center"><?= $publishedPosts; ?></div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            AEAK Updates
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    // Fetch posts from the database
                    $stmt = $pdo->query("SELECT id, post_title, post_date, status FROM member_updates ORDER BY post_date DESC");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['post_title']); ?></td>
                            <td><?= htmlspecialchars($row['post_date']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td><a href="update_post.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Update</a></td>
                            <td><a href="delete_post.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
