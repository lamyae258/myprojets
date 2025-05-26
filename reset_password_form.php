<?php
include('db.php');

if (!isset($_GET['token'])) {
    die('Lien invalide.');
}

$token = $_GET['token'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE password_reset_token = ? AND token_expiry > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Le lien est invalide ou a expiré.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="inscrit.css">
</head>
<body>
  
    <form class="form" method="POST" action="reset_password_process.php">
           <h2 class="pass_rest">Réinitialiser votre mot de passe</h2>
       <img src="image/logo.png" alt="Logo" class="logo-input">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        
        <input type="password" name="new_password" required placeholder="Nouveau mot de passe"><br><br>
        <input type="password" name="confirm_password" required placeholder="confirmer le mot de passe"><br><br>

        <button type="submit">Changer le mot de passe</button>
    </form>
   
</body>
</html>
