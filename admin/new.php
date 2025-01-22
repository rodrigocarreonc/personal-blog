<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/database.php';
$database = new Database();
$con = $database->connection();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $query = "INSERT INTO article (title, date, content) VALUES (:title, :date, :content)";
    $result = $con->prepare($query);
    $result->bindParam(':title', $title);
    $result->bindParam(':date', $date);
    $result->bindParam(':content', $content);
    $result->execute();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Article - Personal Blog</title>
    <link rel="stylesheet" href="../style/admin_new.css">
</head>
<body>
    <div class="path">/new</div>
    <div class="form-container">
        <h1 class="form-title">New Article</h1>
        <form action="new.php" method="POST">
            <div class="form-group">
                <input type="text"  name="title" class="form-control" placeholder="Article Title">
            </div>
            <div class="form-group">
                <input type="text" name="date" class="form-control" placeholder="Publishing Date (MM/DD/YYYY)">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Content"></textarea>
            </div>
            <button type="submit" class="submit-button">Publish</button>
        </form>
    </div>
</body>
</html>