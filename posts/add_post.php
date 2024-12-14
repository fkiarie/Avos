<?php
include 'header.php';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postTitle = $_POST['post_title'];
    $postArticle = $_POST['post_article'];
    $postStatus = $_POST['status'];
    $postImage = '';

    // Handle image upload with absolute path and detailed error handling
    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Avos/images/'; // Absolute path to the upload directory
        
        $imageName = basename($_FILES['post_image']['name']);
        $targetFile = $uploadDir . uniqid() . '_' . $imageName;

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES['post_image']['tmp_name']);

        if ($check === false) {
            echo "<div class='alert alert-danger'>File is not a valid image.</div>";
            exit;
        }

        // Check file size (limit to 5MB)
        if ($_FILES['post_image']['size'] > 5000000) {
            echo "<div class='alert alert-danger'>File size exceeds 5MB.</div>";
            exit;
        }

        // Allow only specific formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "<div class='alert alert-danger'>Only JPG, JPEG, PNG, and GIF formats are allowed.</div>";
            exit;
        }

        if (!move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
            echo "<div class='alert alert-danger'>File upload failed.</div>";
            echo "<p>Ensure the directory exists and has proper permissions.</p>";
            $error = error_get_last();
            echo "<pre>Error: " . print_r($error, true) . "</pre>";
            exit;
        }
        
        // Relative path to save in the database
        $postImage = '/Avos/images/' . basename($targetFile);
    }

    // Insert the new post into the database
    $stmt = $pdo->prepare("INSERT INTO member_updates (post_title, post_article, status, post_image, post_date) VALUES (:title, :article, :status, :image, NOW())");
    $stmt->execute([
        'title' => $postTitle,
        'article' => $postArticle,
        'status' => $postStatus,
        'image' => $postImage,
    ]);

    // Redirect to the dashboard after successful addition
    header("Location:index.php");
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