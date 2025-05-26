<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="inscrit.css">
    <style>
        .message {
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px;
    color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}

    </style>
</head>
<body>
<div id="welcome-screen" class="welcome-screen">
        <img src="image/logo.png" alt="Logo" class="logo">
         <p style="color: white;font-size:30px;">Bienvenue sur notre plateforme !</p>
</div>
<div class="auth-container">
<img src="image/logo.png" alt="Logo" class="logo-input">
    <div class="auth-form">
        <!-- Formulaire de Connexion -->
        <form id="login-form" class="form-content active" action="login.php" method="POST">
            <h2>Connexion</h2>

            <div id="error-message" style="color: red; margin-bottom: 10px; font-family:Arial, Helvetica, sans-serif;"></div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Adresse e-mail" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-links">
                <a href="#" id="forgot-link">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="submit-btn">Se connecter</button>
            <div class="form-links">
                <span>Vous n'avez pas de compte ? <a href="#" id="register-link">Créer un compte</a></span>
            </div>
        </form>

        <!-- Formulaire d'Inscription -->
        <form id="register-form" class="form-content" action="register.php" method="POST">
            <h2>Créer un compte</h2>
            <div id="register-error-message" style="color: red; margin-left: 7rem; font-family:Arial, Helvetica, sans-serif;"></div> 
            <div class="input-box">
                <input type="text" id="name" name="name" placeholder="Nom complet" required>
            </div>
            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Adresse e-mail" required>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="submit-btn">S'inscrire</button>
            <div class="form-links">
                <span>Vous avez déjà un compte ? <a href="#" id="login-link">Se connecter</a></span>
            </div>
        </form>

        <!-- Formulaire de Réinitialisation du Mot de Passe -->
<form id="reset-form" class="form-content" action="reset_password.php" method="POST">
    <h2>Réinitialiser le mot de passe</h2>
    <div class="input-box">
        <input type="email" name="email" placeholder="Entrez votre adresse e-mail" required>
    </div>
    <button type="submit" class="submit-btn">Envoyer le lien</button>
    <div class="form-links">
        <span><a href="#" id="back-to-login">Retour à la connexion</a></span>
    </div>
</form>




    </div>
</div>
    <script src="javascript/inscrit.js" defer></script>
</body>
</html>
