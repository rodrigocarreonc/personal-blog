<?php
include('config/database.php');
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
    <title>Personal Blog</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="path">/home</div>
    <div class="blog-container">
        <h1 class="blog-title">Personal Blog</h1>
        <ul class="article-list">
            <?php if(!$articles): ?>
                <li class="article-item">No articles found</li>
            <?php endif; ?>
            <?php foreach($articles as $article): ?>
                <li class="article-item">
                    <a href="article.php?id=<?php echo $article['article_id']; ?>" class="article-title"><?php echo $article['title']; ?></a>
                    <span class="article-date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>