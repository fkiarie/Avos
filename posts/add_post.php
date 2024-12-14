<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postTitle = $_POST['post_title'];
    $postArticle = $_POST['post_article'];
    $postStatus = $_POST['status'];
    $postImage = '';

    // Handle image upload
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/'; // Path to the images folder (relative to this script)

        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageName = basename($_FILES['post_image']['name']);
        $targetFile = $uploadDir . uniqid() . '_' . $imageName;

        // Validate the uploaded file
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['post_image']['tmp_name']);

        if ($check === false) {
            echo "<div class='alert alert-danger'>File is not a valid image.</div>";
            exit;
        }

        if ($_FILES['post_image']['size'] > 5000000) {
            echo "<div class='alert alert-danger'>File size exceeds 5MB.</div>";
            exit;
        }

        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<div class='alert alert-danger'>Only JPG, JPEG, PNG, and GIF formats are allowed.</div>";
            exit;
        }

        if (!move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
            echo "<div class='alert alert-danger'>File upload failed.</div>";
            exit;
        }

        // Save the relative path for the database
        $postImage = '../images/' . basename($targetFile);
    }

    // Insert the post into the database
    $stmt = $pdo->prepare("INSERT INTO member_updates (post_title, post_article, status, post_image, post_date) VALUES (:title, :article, :status, :image, NOW())");
    $stmt->execute([
        'title' => $postTitle,
        'article' => $postArticle,
        'status' => $postStatus,
        'image' => $postImage,
    ]);

    echo "<script>window.location.href='index.php';</script>";
    exit;
}
?>


    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Add New Post</h1>
            <form method="POST" enctype="multipart/form-data">
                <!-- Post Title -->
                <div class="mb-3">
                    <label for="post_title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter post title" required>
                </div>

                <!-- Post Article -->
                <div class="mb-3">
                    <label for="post_article" class="form-label">Post Article</label>
                    <textarea class="form-control" id="post_article" name="post_article" rows="6" placeholder="Write the post content here..." required></textarea>
                </div>

                <!-- Post Image -->
                <div class="mb-3">
                    <label for="post_image" class="form-label">Post Image</label>
                    <div class="file-input-wrapper">
                        <button class="file-input-btn" type="button">Choose File</button>
                        <input type="file" class="form-control" id="post_image" name="post_image" accept="image/*">
                    </div>
                </div>

                <!-- Post Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Post Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="draft" selected>Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Update file input button text with selected filename
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