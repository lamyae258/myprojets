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
    $sql = "SELECT * FROM non_coastal_cities WHERE city_name LIKE :searchQuery";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':searchQuery', "%$searchQuery%");
    $stmt->execute();
} else {
    $sql = "SELECT * FROM non_coastal_cities";
    $stmt = $pdo->query($sql);
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>non coastal cities</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<video src="image/about-vid-1.mp4" autoplay muted loop class="videoo"></video>
<span class="video-text">Non-Coastal Cities in Morocco</span>
<form method="GET" action="" class="search-form">
    <input type="text" name="search" placeholder="Search for a city..." value="<?= htmlspecialchars($searchQuery) ?>">
    <button type="submit">🔎</button>
</form>
<section class="package">
    <h2 id="fade-in">Non-Coastal Cities in Morocco</h2>
    <p class="p" id="fade-in">Non-coastal destinations in Morocco offer a unique travel experience, showcasing the country's diverse landscapes and rich culture 🌍. 
        Cities like Marrakech 🏙️ and Fes 🕌 are known for their historic medinas, vibrant markets 🛍️, and cultural landmarks 🏰.
         Inland regions like Azilal 🏞️, Ifrane 🌲, and Zagora 🏜️ provide stunning natural beauty, from the Atlas Mountains 🏔️ to the Sahara Desert 🌵, 
         offering adventure and tranquility 🧘‍♂️. These destinations highlight Morocco's heritage 🇲🇦,
         making them perfect for those seeking an authentic and off-the-beaten-path experience ✈️</p>
    <div class="city-container">
    <?php while ($city = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="city-wrapper" id="fade-in">
            <div class="city">
                <a href="city_gallery_noCoastal.php?city_slug=<?= $city['city_slug'] ?>" class="city-content">
                    <img src="<?= $city['city_image'] ?>" alt="<?= $city['city_name'] ?>" class="city-image">
                    <div class="city-name"><?= $city['city_name'] ?></div>
                </a>
            </div>
            <div class="city-description">
                <p><?= $city['city_description'] ?></p>
                <a href="booking.php" class="btn-booking">booking</a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</section>
<script src="javascript/destination.js"></script>
</body>
</html>
