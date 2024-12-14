<?php
include 'header.php';


// Check if the `id` is provided and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $articleId = intval($_GET['id']);

    // Fetch the article from the database
    $stmt = $pdo->prepare("SELECT * FROM member_updates WHERE id = :id AND status = 'published'");
    $stmt->execute(['id' => $articleId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        echo "<div class='container text-center py-5'><h1 class='text-danger'>Article Not Found</h1></div>";
        include 'footer.php';
        exit;
    }
} else {
    echo "<div class='container text-center py-5'><h1 class='text-danger'>Invalid Article ID</h1></div>";
    include 'footer.php';
    exit;
}
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown"><?= htmlspecialchars($article['post_title']); ?></h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="blog.php">Blog</a></li>
                <li class="breadcrumb-item text-dark" aria-current="page">Article</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Article Content Start -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <img class="card-img-top" src="<?= htmlspecialchars($article['post_image']); ?>" alt="Article Image">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?= htmlspecialchars($article['post_date']); ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($article['post_article'])); ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="blog.php" class="btn btn-outline-primary rounded-pill">Back to Blog</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Article Content End -->

<!-- Footer -->
<?php include 'footer.php'; ?>