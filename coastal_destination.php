<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header("Location: home.php"); 
    exit();
}
$user_name = isset($_SESSION['users_name']) ? $_SESSION['users_name'] : "Invité";

require 'db.php';

// ✅ Traitement de la recherche
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// ✅ Mise à jour de la requête selon la recherche
if (!empty($searchQuery)) {
    $sql = "SELECT * FROM coastal_cities WHERE city_name LIKE :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':searchQuery', "%$searchQuery%");
    $stmt->execute();
} else {
    $sql = "SELECT * FROM coastal_cities";
    $stmt = $pdo->query($sql);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Villes Côtières</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<video src="uploadeAdmin/video_coastal.mp4" autoplay muted loop class="videoo"></video>
<span class="video-text">Villes Côtières au Maroc</span>
<form method="GET" action="" class="search-form">
    <input type="text" name="search" placeholder="Rechercher une ville..." value="<?= htmlspecialchars($searchQuery) ?>">
    <button type="submit">🔎</button>
</form>

<section class="package">
    <h2>Villes Côtières au Maroc</h2>
    <p class="p" id="fade-in">Les joyaux de la mer et les secrets de beauté 🌊✨
        Le Maroc se distingue par sa géographie diversifiée : montagnes 🏞️, déserts 🌵 et côtes 🏖️. 
        Il abrite un groupe de villes côtières connues pour leur beauté naturelle 🌅, leur riche histoire 🏛️ et leur patrimoine culturel vibrant 🎨. 
        La côte marocaine s'étend sur plus de 3 500 kilomètres entre la mer Méditerranée 🌊 et l'océan Atlantique 🌊, 
        ce qui en fait une destination prisée par de nombreux touristes locaux et internationaux 🌍.
    </p>
    <!-- ✅ Villes côtières -->
    <div class="city-container">
        <?php while ($city = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="city-wrapper" id="fade-in">
                <div class="city">
                    <a href="city_gallery.php?city_slug=<?= $city['city_slug'] ?>" class="city-content">
                        <img src="<?= htmlspecialchars($city['city_image']) ?>" alt="<?= htmlspecialchars($city['city_name']) ?>" class="city-image">
                        <div class="city-name"><?= htmlspecialchars($city['city_name']) ?></div>
                    </a>
                </div>
                <div class="city-description">
                    <p><?= htmlspecialchars($city['city_description']) ?></p>
                    <a href="booking.php" class="btn-booking">Réserver</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<script src="javascript/destination.js"></script>
</body>
</html>
