<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT m.*, a.title AS ad_title, u.email AS buyer_email 
                        FROM messages m
                        JOIN ads a ON m.ad_id = a.id
                        JOIN users u ON m.buyer_id = u.id
                        WHERE m.seller_id = ?");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Messages</title>
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
            padding: 20px;
        }
        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #002f34;
        }
        .message {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .message p {
            font-size: 16px;
            margin: 10px 0;
            color: #002f34;
        }
        .message strong {
            font-weight: 500;
        }
        .message em {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Your Messages</h1>
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <p><strong>Ad:</strong> <?php echo htmlspecialchars($message['ad_title']); ?></p>
            <p><strong>From:</strong> <?php echo htmlspecialchars($message['buyer_email']); ?></p>
            <p><strong>Message:</strong> <?php echo htmlspecialchars($message['message']); ?></p>
            <p><em>Sent on: <?php echo htmlspecialchars($message['created_at']); ?></em></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
