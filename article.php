<?php
require_once 'config/database.php';

$_id = $_GET['id'];

$database = new Database();
$con = $database->connection();
$query = "SELECT * FROM article WHERE article_id = $_id";
$result = $con->prepare($query);
$result->execute();
$article = $result->fetch(PDO::FETCH_ASSOC);
if(!$article){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title'];?></title>
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
        .article-container {
            border: 2px solid #333;
            padding: 20px;
            border-radius: 8px;
        }
        .article-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .article-date {
            color: #666;
            margin-bottom: 20px;
            display: block;
        }
        .article-content {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="article-container">
        <h1 class="article-title"><?php echo $article['title'] ?></h1>
        <span class="article-date"><?php echo date('F j, Y', strtotime($article['date'])) ?></span>
        <div class="article-content">
            <p><?php echo $article['content'] ?></p>
        </div>
    </div>
</body>
</html>