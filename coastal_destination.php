<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header("Location: home.php"); 
    exit();
}
$user_name = isset($_SESSION['users_name']) ? $_SESSION['users_name'] : "Guest";

require 'db.php';

// ✅ معالجة البحث
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// ✅ تحديث الاستعلام حسب البحث
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
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>cities coastal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<video src="uploadeAdmin/video_coastal.mp4" autoplay muted loop class="videoo"></video>
<span class="video-text">Coastal Cities in Morocco</span>
<form method="GET" action="" class="search-form">
    <input type="text" name="search" placeholder="Search for a city..." value="<?= htmlspecialchars($searchQuery) ?>">
    <button type="submit">🔎</button>
</form>

<section class="package">
    <h2>Coastal Cities in Morocco</h2>
    <p class="p" id="fade-in">Jewels of the Sea and Secrets of Beauty 🌊✨
        Morocco is distinguished by its diverse geography of mountains 🏞️, deserts 🌵, and coasts 🏖️. 
        It is home to a group of coastal cities known for their natural beauty 🌅, rich history 🏛️, and vibrant cultural heritage 🎨. 
        The Moroccan coastline stretches over 3,500 kilometers between the Mediterranean Sea 🌊 and the Atlantic Ocean 🌊, 
        making it a favorite destination for many local and international tourists 🌍.
    </p>

    <!-- ✅ المدن الساحلية -->
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
                    <a href="booking.php" class="btn-booking">Booking</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<script src="javascript/destination.js"></script>





</body>
</html>
