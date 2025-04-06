<?php
session_start();
include("db.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    $stmt = $pdo->prepare("SELECT users_id, name, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['users_id'] = $user['users_id'];
        $_SESSION['user_name'] = $user['name'];
        echo json_encode(["status" => "success", "redirect" => "home.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid email or password."]);
    }
    exit();
}
?>

