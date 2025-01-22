<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/database.php';

$database = new Database();
$con = $database->connection();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $query = "UPDATE article SET title = :title, date = :date, content = :content WHERE article_id = $id";
    $result = $con->prepare($query);
    $result->bindParam(':title', $_POST['title']);
    $result->bindParam(':date', $_POST['date']);
    $result->bindParam(':content', $_POST['content']);
    $result->execute();
    header('Location: index.php');
    exit;
}


$_id = $_GET['id'];
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
    <title>Edit Article - Personal Blog</title>
    <link rel="stylesheet" href="../style/admin_edit.css">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Update Article</h1>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $article['article_id']?>">
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Article Title" value="<?php echo $article['title']?>">
            </div>
            <div class="form-group">
                <input type="text" name="date" class="form-control" placeholder="Publishing Date" value="<?php echo $article['date']?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Content"><?php echo $article['content'] ?></textarea>
            </div>
            <button type="submit" class="submit-button">Update</button>
        </form>
    </div>
</body>
</html>