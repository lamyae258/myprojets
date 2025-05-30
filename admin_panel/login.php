<?php
session_start();
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_logged_in'] = true;

            header("Location: ../admin_panel/index.php");
            exit();
        } else {
            $error_message = "Nom d'utilisateur ou mot de passe invalide.";
        }
    } else {
        $error_message = "Le nom d'utilisateur et le mot de passe doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>

        <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>

        <form action="login.php" method="post" class="login">
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <button type="submit">Se connecter</button>
            </div>
        </form>

    </div>
</body>
</html>
