<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
<header class="header">
<?php
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    echo "
        <h1 style='display: flex; align-items: center;margin-left:3rem; gap: 4px;'>
            <span style='font-size: 12px;'>".htmlspecialchars($user_name)."</span>
            <i class='fas fa-user' style='font-size: 14px;'></i>
            <span style='font-size: 11px; margin-left: auto;'>🟢</span>
        </h1>
    ";
} else {
    echo "Vous n'êtes pas encore connecté.";
}
?>

    <span class="malg">
        <img src="image/logo.png" alt="Logo MALGAR" class="logo">
    </span>
    <nav class="navbar">
        <a href="home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">Accueil</a>
        <a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">À propos</a>
        <a href="blogs.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blogs.php' ? 'active' : ''; ?>">Blogs</a>
        <div class="dropdown">
            <a class="droplng">Destination<i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content">
                <a href="coastal_destination.php">Coastal Destination</a>
                <a href="non_coastal_destination.php">non Coastal Destination</a>
            </div>
        </div>
        <a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a>
        <a href="booking.php"  class="<?php echo basename($_SERVER['PHP_SELF']) == 'booking.php' ? 'active' : ''; ?>">Réservation</a>
        <a href="inscrit.php" class="btn-register">S'inscrire</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
<script src="javascript/navbar.js"></script>
</body>
</html>
