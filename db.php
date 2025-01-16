<?php
$host = 'localhost';
$dbname = 'dbfkgu4gkysii1';
$user = 'uqn2r2mzbhtl5';
$password = 'gtjambej8nyy';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
