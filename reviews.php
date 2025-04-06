<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['users_id'])) {
        echo json_encode(["success" => false, "message" => "You must be logged in to submit a comment."]);
        exit();
    }

    $user_id = $_SESSION['users_id'];
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comment = isset($_POST['content']) ? trim($_POST['content']) : '';

    if ($rating <= 0 || empty($comment)) {
        echo json_encode(["success" => false, "message" => "Please enter a valid rating and comment."]);
        exit();
    }

    try {
        $sql = "INSERT INTO reviews (users_id, rating, comment) VALUES (:users_id, :rating, :comment)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':users_id', $user_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        $sql = "SELECT r.rating, r.comment, r.created_at, u.name 
                FROM reviews r
                JOIN users u ON r.users_id = u.users_id
                ORDER BY r.created_at DESC";
        $stmt = $pdo->query($sql);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "reviews" => $reviews]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "An error occurred while submitting the comment.", "error" => $e->getMessage()]);
        exit();
    }
}
?>
