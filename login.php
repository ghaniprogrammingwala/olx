<?php
include 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
    } else {
        echo "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 10px rgba(0,0,0,0.1);
            width: 400px;
            padding: 30px;
            transform: scale(1);
        }
        .login-container:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transform: scale(1.02);
        }
        .login-title {
            text-align: center;
            margin-bottom: 20px;
            color: #002f34;
            font-size: 24px;
            font-weight: 500;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        .login-form input {
            margin-bottom: 15px;
            padding: 12px 15px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .login-form input:focus {
            outline: none;
            border-color: #002f34;
            box-shadow: 0 0 0 2px rgba(0,47,52,0.2);
        }
        .login-form input:hover {
            border-color: #002f34;
        }
        .login-btn {
            background-color: #002f34;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            background-color: #005b5b;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .signup-link {
            text-align: center;
            margin-top: 15px;
            color: #002f34;
        }
        .signup-link a {
            color: #002f34;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .signup-link a:hover {
            color: #005b5b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Login to Your Account</h2>
        <form method="POST" class="login-form">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
