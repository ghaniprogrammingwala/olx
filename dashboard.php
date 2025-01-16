<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$stmt = $conn->query("SELECT * FROM ads");
$ads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX Dashboard</title>
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
        .header-buttons {
            display: flex;
            gap: 10px;
        }
        .header-btn {
            background-color: #fff;
            color: #002f34;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .header-btn:hover {
            background-color: #f1f1f1;
        }
        .ads-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .ad-card {
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        .ad-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .ad-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #f9f9f9;
        }
        .ad-details {
            padding: 15px;
        }
        .ad-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #002f34;
        }
        .ad-description {
            color: #606060;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .ad-price {
            font-size: 18px;
            font-weight: 700;
            color: #002f34;
        }
        .view-ad-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #002f34;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .view-ad-btn:hover {
            background-color: #005b5b;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h2>My OLX</h2>
        <div class="header-buttons">
            <a href="post-ad.php" class="header-btn">Post Ad</a>
            <a href="message.php" class="header-btn">Messages</a>
        </div>
    </div>
    <div class="ads-container">
        <?php foreach ($ads as $ad): ?>
            <div class="ad-card">
                <?php 
                // Check if the image is a URL or a file path
                $image = filter_var($ad['image'], FILTER_VALIDATE_URL) ? $ad['image'] : "assets/" . htmlspecialchars($ad['image']); 
                ?>
                <img src="<?php echo $image; ?>" alt="Ad Image" class="ad-image">
                <div class="ad-details">
                    <h3 class="ad-title"><?php echo htmlspecialchars($ad['title']); ?></h3>
                    <p class="ad-description"><?php echo htmlspecialchars(substr($ad['description'], 0, 50)) . '...'; ?></p>
                    <p class="ad-price">$<?php echo number_format($ad['price'], 2); ?></p>
                </div>
                <a href="ad-detail.php?id=<?php echo $ad['id']; ?>" class="view-ad-btn">View Ad</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
