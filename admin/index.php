<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';
$database = new Database();
$con = $database->connection();
$query = "SELECT * FROM article ORDER BY created_at DESC";
$result = $con->prepare($query);
$result->execute();
$articles = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Personal Blog</title>
    <link rel="stylesheet" href="../style/admin_index.css">
</head>
<body>
    <div class="path">/admin</div>
    <div class="blog-container">
        <div class="blog-header">
            <h1 class="blog-title">Personal Blog</h1>
            <a href="new.php" class="add-button">+ Add</a>
        </div>
        <ul class="article-list">
            <?php if(!$articles): ?>
                <li class="article-item">No articles found</li>
            <?php endif; ?>
            <?php foreach($articles as $article): ?>
                <li class="article-item">
                    <span class="article-title"><?php echo $article['title']; ?></span>
                    <div class="article-actions">
                        <a href="edit.php?id=<?php echo $article['article_id'] ?>" class="action-link">Edit</a>
                        <a href="delete.php?id=<?php echo $article['article_id']?>" class="action-link">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>