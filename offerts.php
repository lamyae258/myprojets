<?php
session_start();
include("db.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_type = $_POST['offer_type'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $user_id = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : NULL; // إذا كان المستخدم مسجل الدخول
    if (empty($offer_type) || empty($name) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO offers (users_id, offer_type, name, email) VALUES (:users_id, :offer_type, :name, :email)");
        $stmt->bindParam(':users_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':offer_type', $offer_type, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Booking confirmed successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Booking failed. Please try again."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
    exit();
}
?>
