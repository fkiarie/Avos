<?php
include 'auth_check.php';
include 'db_connect.php';
session_start();

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT post_image FROM member_updates WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        if (!empty($post['post_image']) && file_exists($post['post_image'])) {
            unlink($post['post_image']);
        }

        $deleteStmt = $pdo->prepare("DELETE FROM member_updates WHERE id = :id");
        $deleteStmt->execute(['id' => $postId]);

        
        $_SESSION['message'] = "Post deleted successfully.";
    }
}


header("Location: index.php");
exit;
?>
