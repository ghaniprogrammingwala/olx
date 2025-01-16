<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image_url'];  // Now using image URL instead of file upload
    $stmt = $conn->prepare("INSERT INTO ads (user_id, title, description, price, category, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $description, $price, $category, $image]);
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Ad - OLX</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f4f4;
            color: #002f34;
        }
        .dashboard-header {
            background-color: #002f34;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .dashboard-header h2 {
            font-size: 20px;
        }
        .dashboard-header a {
            color: white;
            text-decoration: none;
        }
        .post-ad-container {
            max-width: 500px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .post-ad-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #002f34;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #002f34;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #002f34;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #002f34;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #005b5b;
        }
        .back-to-dashboard {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #002f34;
            text-decoration: none;
        }
        .back-to-dashboard:hover {
            text-decoration: underline;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h2>OLX</h2>
        <a href="dashboard.php">Dashboard</a>
    </div>
    <div class="post-ad-container">
        <h2>Post New Ad</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter ad title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Describe your item" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" placeholder="Set your price" required min="0" step="0.01">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select a category</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Vehicles">Vehicles</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Fashion">Fashion</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="url" id="image_url" name="image_url" class="form-control" placeholder="Paste image URL" required>
            </div>
            <button type="submit" class="submit-btn">Post Ad</button>
        </form>
        <a href="dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
