<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    // Redirect to login.php after successful signup
    header("Location: login.php");
    exit(); // Ensure no further code is executed
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
        .signup-container {
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 10px rgba(0,0,0,0.1);
            width: 400px;
            padding: 30px;
            transform: scale(1);
        }
        .signup-container:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transform: scale(1.02);
        }
        .signup-title {
            text-align: center;
            margin-bottom: 20px;
            color: #002f34;
            font-size: 24px;
            font-weight: 500;
        }
        .signup-form {
            display: flex;
            flex-direction: column;
        }
        .signup-form input {
            margin-bottom: 15px;
            padding: 12px 15px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .signup-form input:focus {
            outline: none;
            border-color: #002f34;
            box-shadow: 0 0 0 2px rgba(0,47,52,0.2);
        }
        .signup-form input:hover {
            border-color: #002f34;
        }
        .signup-btn {
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
        .signup-btn:hover {
            background-color: #005b5b;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
            color: #002f34;
        }
        .login-link a {
            color: #002f34;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .login-link a:hover {
            color: #005b5b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2 class="signup-title">Create an Account</h2>
        <form method="POST" class="signup-form">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="signup-btn">Create Account</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="#">Login</a>
        </div>
    </div>
</body>
</html>
