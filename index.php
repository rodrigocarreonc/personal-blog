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
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .path {
            color: #333;
            margin-bottom: 20px;
        }
        .blog-container {
            border: 2px solid #333;
            padding: 20px;
            border-radius: 8px;
        }
        .blog-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .article-list {
            list-style: none;
            padding: 0;
        }
        .article-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .article-title {
            color: #000;
            text-decoration: none;
        }
        .article-title:hover {
            text-decoration: underline;
        }
        .article-date {
            color: #666;
        }
    </style>
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
            <li class="article-item">
                <a href="article.html" class="article-title">My first article</a>
                <span class="article-date">August 7, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Second article</a>
                <span class="article-date">August 4, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Third article</a>
                <span class="article-date">August 1, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Fourth article</a>
                <span class="article-date">July 30, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Fifth article</a>
                <span class="article-date">July 21, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Sixth article</a>
                <span class="article-date">July 15, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Seventh article</a>
                <span class="article-date">July 8, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Eighth article</a>
                <span class="article-date">July 4, 2024</span>
            </li>
            <li class="article-item">
                <a href="#" class="article-title">Nineth Article</a>
                <span class="article-date">July 1, 2024</span>
            </li>
        </ul>
    </div>
</body>
</html>