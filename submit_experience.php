<?php
session_start();
require 'db.php';
header('Content-Type: application/json');
if (!isset($_SESSION['users_id'])) {
    echo json_encode(["error" => "⚠ You must be logged in to submit an experience."]);
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_comment'])) {
    $user_comment = trim($_POST['user_comment']);
    $user_id = $_SESSION['users_id']; 

    if (!empty($user_comment)) {
        try {
            
            $stmt = $pdo->prepare("INSERT INTO experiences (users_id, user_comment) VALUES (:users_id, :user_comment)");
            $stmt->bindParam(':users_id', $user_id);
            $stmt->bindParam(':user_comment', $user_comment);
            $stmt->execute();

           
            $stmt = $pdo->prepare("SELECT name FROM users WHERE users_id = :users_id");
            $stmt->bindParam(':users_id', $user_id);
            $stmt->execute();
            $user = $stmt->fetch();

           
            echo json_encode([
                "success" => true,
                "name" => $user['name'],
                "user_comment" => $user_comment,
                "created_at" => date("Y-m-d H:i:s")
            ]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "⚠ Database Error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "⚠ Please write something before submitting."]);
    }
}
?>
