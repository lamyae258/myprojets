<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Email incorrect';
        exit;
    }

    $stmt = $pdo->prepare("SELECT users_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Aucun compte enregistré avec cette adresse email.";
        exit;
    }

    $token = bin2hex(random_bytes(50));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $pdo->prepare("UPDATE users SET password_reset_token = ?, token_expiry = ? WHERE email = ?");
    $stmt->execute([$token, $expires, $email]);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lamlamyae2003@gmail.com';
        $mail->Password = 'atbt cdbn xexy lllk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@localhost.com', 'No Reply');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Demande de réinitialisation du mot de passe';
        $mail->Body = 'Cliquez sur ce lien pour réinitialiser votre mot de passe : <a href="http://localhost/myprojet/reset_password_form.php?token=' . $token . '">Réinitialiser le mot de passe</a>';
        $mail->send();
        echo 'Le lien de réinitialisation du mot de passe a été envoyé à votre adresse email.';
    } catch (Exception $e) {
        echo "Erreur d'envoi de l'email : " . $mail->ErrorInfo;
    }
}
