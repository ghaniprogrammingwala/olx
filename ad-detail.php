<?php
include 'db.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Ad not found.";
    exit;
}

$ad_id = $_GET['id'];

// Fetch ad details
$stmt = $conn->prepare("SELECT ads.*, users.email AS seller_email FROM ads JOIN users ON ads.user_id = users.id WHERE ads.id = ?");
$stmt->execute([$ad_id]);
$ad = $stmt->fetch();

if (!$ad) {
    echo "Ad not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($ad['title']); ?></title>
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
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .ad-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .ad-title {
            font-size: 28px;
            font-weight: 700;
            color: #002f34;
            margin-bottom: 15px;
        }
        .ad-price {
            font-size: 24px;
            color: #28a745;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .ad-description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .seller-info {
            background-color: #f0f8ff;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .seller-info p {
            margin: 0;
            font-size: 16px;
        }
        .contact-form h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #002f34;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #005b5b;
        }
        a {
            color: #002f34;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo htmlspecialchars($ad['image']); ?>" alt="Ad Image" class="ad-image">
        <h1 class="ad-title"><?php echo htmlspecialchars($ad['title']); ?></h1>
        <p class="ad-price">Price: $<?php echo htmlspecialchars($ad['price']); ?></p>
        <p class="ad-description"><?php echo htmlspecialchars($ad['description']); ?></p>

        <div class="seller-info">
            <p><strong>Seller Email:</strong> <?php echo htmlspecialchars($ad['seller_email']); ?></p>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="contact-form">
                <h3>Contact Seller</h3>
                <form method="POST" action="contact-seller.php">
                    <input type="hidden" name="ad_id" value="<?php echo htmlspecialchars($ad['id']); ?>">
                    <textarea name="message" placeholder="Write your message..." required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        <?php else: ?>
            <p><a href="login.php">Log in</a> to contact the seller.</p>
        <?php endif; ?>
    </div>
</body>
</html>
