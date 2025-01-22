<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/database.php';
    $database = new Database();
    $con = $database->connection();
    $query = "SELECT * FROM users WHERE username = :username";
    $result = $con->prepare($query);
    $result->bindParam(':username', $_POST['username']);
    $result->execute();
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if ($user && $_POST['password'] === $user['password']) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Personal Blog</title>
    <link rel="stylesheet" href="../style/admin_login.css">
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="username" 
                    id="username" 
                    name="username" 
                    class="form-control" 
                    required 
                    autocomplete="username"
                    minlength="3"
                >
                <div class="error-message">Please enter a valid username (minimum 3 characters)</div>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control" 
                    required 
                    autocomplete="current-password"
                    minlength="8"
                >
                <div class="error-message">Password must be at least 8 characters long</div>
            </div>
            <button type="submit" class="submit-button">Login</button>
        </form>
    </div>
</body>
</html>