<?php
require 'db.php';
$hotel_id = $_GET['hotel_id'];

$sql = "SELECT image_path FROM hotel_images WHERE hotel_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$hotel_id]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($images);
