<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password !== $confirm_password) {
        die('Les mots de passe ne correspondent pas.');
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE password_reset_token = ? AND token_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die('Le lien est invalide ou a expiré.');
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ?, password_reset_token = NULL, token_expiry = NULL WHERE users_id = ?");
    $stmt->execute([$hashed_password, $user['users_id']]);

    // رسالة النجاح مع رابط العودة للصفحة الرئيسية للدخول
    echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mot de passe mis à jour</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 40px; text-align: center; }
            .message-box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); display: inline-block; }
            a { color: #007BFF; text-decoration: none; font-weight: bold; }
            a:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <div class="message-box">
            <h2>Mot de passe mis à jour avec succès !</h2>
            <p><a href="inscrit.php">Cliquez ici pour vous connecter</a></p>
        </div>
    </body>
    </html>';
} else {
    die('Méthode de requête incorrecte.');
}
?>
