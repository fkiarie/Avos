<?php
include 'auth_check.php';
include 'header.php';

$searchResults = [];
$searchQuery = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
    $searchQuery = trim($_GET['query']);
    if (!empty($searchQuery)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM member_updates WHERE post_title LIKE :query OR post_article LIKE :query ORDER BY post_date DESC");
            $stmt->execute(['query' => '%' . $searchQuery . '%']);
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            echo "<p class='text-danger'>An error occurred while fetching search results.</p>";
        }
    }
}
?>

<main class="container-fluid px-4">
    <h1 class="mt-4">Search Results</h1>
    <?php if (empty($searchResults) && !empty($searchQuery)): ?>
        <p class="text-danger">No results found for "<?= htmlspecialchars($searchQuery); ?>"</p>
    <?php endif; ?>

    <?php if (!empty($searchResults)): ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-search me-1"></i> Search Results for "<?= htmlspecialchars($searchQuery); ?>"
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $result): ?>
                            <tr>
                                <td><?= htmlspecialchars($result['id']); ?></td>
                                <td><?= htmlspecialchars($result['post_title']); ?></td>
                                <td><?= htmlspecialchars($result['post_date']); ?></td>
                                <td><?= htmlspecialchars($result['status']); ?></td>
                                <td>
                                    <a href="update_post.php?id=<?= $result['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                    <a href="delete_post.php?id=<?= $result['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</main>
