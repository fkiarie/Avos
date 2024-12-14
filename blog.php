<?php 
include 'header.php'; 
include 'db_connect.php';

// Handle pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$articlesPerPage = 10;
$offset = ($page - 1) * $articlesPerPage;

try {
    // Fetch published articles with pagination
    $query = "SELECT id, post_date, post_title, post_article, post_image 
              FROM member_updates 
              WHERE status = 'published' 
              ORDER BY post_date DESC 
              LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', $articlesPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch total number of articles for pagination
    $totalQuery = "SELECT COUNT(*) FROM member_updates WHERE status = 'published'";
    $totalArticles = $pdo->query($totalQuery)->fetchColumn();
    $totalPages = ceil($totalArticles / $articlesPerPage);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "<p class='text-danger'>An error occurred while fetching articles.</p>";
    include 'footer.php';
    exit;
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">AEAK Updates</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-dark" aria-current="page">Articles</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Article Section Start -->
<div class="container-fluid py-5">
    <div class="container">
        <?php if ($stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="row g-5 mb-5">
                    <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid" src="<?= htmlspecialchars($row['post_image']); ?>" alt="Article Image">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="section-title">
                            <p class="fs-5 fw-medium fst-italic text-primary"><?= htmlspecialchars($row['post_date']); ?></p>
                            <h1 class="display-6"><?= htmlspecialchars($row['post_title']); ?></h1>
                        </div>
                        <p class="mb-4"><?= htmlspecialchars(substr($row['post_article'], 0, 200)); ?>...</p>
                        <a href="article.php?id=<?= $row['id']; ?>" class="btn btn-primary rounded-pill py-3 px-5">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No articles available at the moment.</p>
        <?php endif; ?>

        <!-- Pagination Start -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- Pagination End -->
    </div>
</div>
<!-- Article Section End -->

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
