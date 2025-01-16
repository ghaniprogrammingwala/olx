<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad_id = $_POST['ad_id'];
    $message = $_POST['message'];
    $buyer_id = $_SESSION['user_id'] ?? 0;

    if (!$buyer_id) {
        header("Location: login.php");
        exit;
    }

    // Fetch the seller's ID
    $stmt = $conn->prepare("SELECT user_id FROM ads WHERE id = ?");
    $stmt->execute([$ad_id]);
    $seller_id = $stmt->fetchColumn();

    if ($seller_id) {
        $stmt = $conn->prepare("INSERT INTO messages (buyer_id, seller_id, ad_id, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$buyer_id, $seller_id, $ad_id, $message]);
        echo "Message sent to the seller!";
    } else {
        echo "Seller not found.";
    }
} else {
    echo "Invalid request.";
}
?>
