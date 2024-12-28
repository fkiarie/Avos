<?php
session_start();
include 'auth_check.php';
include 'header.php';

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT * FROM member_updates WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        echo "Post not found!";
        exit;
    }
} else {
    echo "Invalid post ID!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postTitle = $_POST['post_title'];
    $postArticle = $_POST['post_article'];
    $postStatus = $_POST['status'];
    $postImage = $post['post_image']; // Default to current image if no new one is uploaded

    // Handle image upload
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/'; // Ensure this path matches the actual location of your images folder

        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageName = basename($_FILES['post_image']['name']);
        $targetFile = $uploadDir . uniqid() . '_' . $imageName;

        // Validate the image file
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['post_image']['tmp_name']);

        if ($check === false) {
            echo "<div class='alert alert-danger'>File is not a valid image.</div>";
            exit;
        }

        if ($_FILES['post_image']['size'] > 5000000) { // Limit file size to 5MB
            echo "<div class='alert alert-danger'>File size exceeds 5MB.</div>";
            exit;
        }

        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<div class='alert alert-danger'>Only JPG, JPEG, PNG, and GIF formats are allowed.</div>";
            exit;
        }

        if (!move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
            echo "<div class='alert alert-danger'>Failed to upload the new image.</div>";
            exit;
        }

        // Save the relative path for the database
        $postImage = '../images/' . basename($targetFile);
    }

    // Update the post data in the database
    $updateStmt = $pdo->prepare("UPDATE member_updates SET post_title = :title, post_article = :article, status = :status, post_image = :image WHERE id = :id");
    $updateStmt->execute([
        'title' => $postTitle,
        'article' => $postArticle,
        'status' => $postStatus,
        'image' => $postImage,
        'id' => $postId,
    ]);

    echo "<script>window.location.href='posts.php';</script>";
    exit;
}
?>
<div class="container">
    <div class="form-container">
        <h1 class="form-title">Update Post</h1>
        <form method="POST" enctype="multipart/form-data">
            <!-- Post Title -->
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($post['post_title']); ?>" required>
            </div>

            <!-- Post Article -->
            <div class="mb-3">
                <label for="post_article" class="form-label">Post Article</label>
                <textarea class="form-control" id="post_article" name="post_article" rows="6" required><?= htmlspecialchars($post['post_article']); ?></textarea>
            </div>

            <!-- Post Image -->
            <div class="mb-3">
                <label for="post_image" class="form-label">Post Image</label>
                <div class="file-input-wrapper">
                    <button class="file-input-btn" type="button">Choose File</button>
                    <input type="file" class="form-control" id="post_image" name="post_image" accept="image/*">
                </div>
                <?php if ($post['post_image']): ?>
                    <div class="mt-3">
                        <img src="<?= htmlspecialchars($post['post_image']); ?>" alt="Current Image" class="image-preview">
                        <p class="text-muted">Current Image</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Post Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Post Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?= $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Optional: Update file input button text with selected filename
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        var fileInputBtn = document.querySelector('.file-input-btn');
        fileInputBtn.textContent = fileName;
    });
</script>
</body>

</html>

<?php
include 'footer.php';
?>