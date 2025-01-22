<?php
    session_start();
    if (isset($_SESSION['email'])) {
        header('Location: ../personal-blog/admin');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../config/database.php';
        $database = new Database();
        $con = $database->connection();
        $query = "SELECT * FROM users WHERE email = :email";
        $result = $con->prepare($query);
        $result->bindParam(':email', $_POST['email']);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['email'] = $user['email'];
            header('Location: ../personal-blog/admin');
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
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .path {
            color: #333;
            margin-bottom: 20px;
        }
        .login-container {
            border: 2px solid #333;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            width: 100%;
        }
        .login-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 2px solid #333;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #666;
        }
        .submit-button {
            background: none;
            border: 2px solid #333;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .submit-button:hover {
            background: #f0f0f0;
        }
        .error-message {
            color: #dc2626;
            font-size: 14px;
            margin-top: 4px;
            display: none;
        }
        .form-control:invalid:not(:focus) + .error-message {
            display: block;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <form action="/admin" method="POST">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    required 
                    autocomplete="email"
                    minlength="3"
                >
                <div class="error-message">Please enter a valid email (minimum 3 characters)</div>
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