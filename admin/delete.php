<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
require_once '../config/database.php';
$id = $_GET['id'];
$database = new Database();
$con = $database->connection();
$query = "DELETE FROM article WHERE article_id = $id";
$result = $con->prepare($query);
$result->execute();
header("Location: index.php");
exit;
?>