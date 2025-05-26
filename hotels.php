<?php
require 'db.php';

// Récupérer le city_slug depuis l'URL
$citySlug = isset($_GET['city_slug']) ? $_GET['city_slug'] : '';
$sqlCity = "SELECT * FROM coastal_cities WHERE city_slug = :city_slug";
$stmtCity = $pdo->prepare($sqlCity);
$stmtCity->bindParam(':city_slug', $citySlug);
$stmtCity->execute();
$city = $stmtCity->fetch(PDO::FETCH_ASSOC);

if ($city) {
    $cityId = $city['city_id'];
    $cityName = $city['city_name'];

    // Récupérer les hôtels associés à cette ville
    $sqlHotels = "SELECT h.*, c.city_name FROM hotels h 
                  JOIN coastal_cities c ON h.city_id = c.city_id
                  WHERE h.city_id = :city_id";
    $stmtHotels = $pdo->prepare($sqlHotels);
    $stmtHotels->bindParam(':city_id', $cityId);
    $stmtHotels->execute();
    $hotels = $stmtHotels->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Ville non trouvée.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hôtels à <?= htmlspecialchars($cityName) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Hôtels à <?= htmlspecialchars($cityName) ?></h2>

    <div class="hotels-container">
        <?php if ($hotels): ?>
            <?php foreach ($hotels as $hotel): ?>
                <div class="hotel-card">
                    <div class="hotel-inner">
                        <img src="http://localhost/myprojet/uploadeAdmin/hotels/<?= htmlspecialchars($hotel['image_path']) ?>" alt="Image de l'hôtel">
                        <div class="hotel-info">
                            <h3><?= htmlspecialchars($hotel['hotel_name']) ?></h3>
                            <p><strong>Ville :</strong> <?= htmlspecialchars($hotel['city_name']) ?></p>
                            <p><strong>Étoiles :</strong> <?= htmlspecialchars($hotel['stars']) ?>⭐</p>
                            <p><strong>Prix :</strong> <?= htmlspecialchars($hotel['price_per_night']) ?> MAD par nuit</p>
                            <p><strong>Emplacement :</strong> <?= htmlspecialchars($hotel['location']) ?></p>
                            <button class="view-images-btn" onclick="showImages(<?= $hotel['hotel_id'] ?>)">Voir les images</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun hôtel trouvé dans cette ville.</p>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content" id="modalImages"></div>
    </div>

    <script>
    function showImages(hotelId) {
        fetch('image_galery_hotel.php?hotel_id=' + hotelId)
            .then(response => response.json())
            .then(images => {
                const modal = document.getElementById('imageModal');
                const modalImages = document.getElementById('modalImages');
                modalImages.innerHTML = '';
                images.forEach(img => {
                    const imageElement = document.createElement('img');
                    imageElement.src = 'http://localhost/myprojet/uploadeAdmin/hotels/' + img.image_path;
                    modalImages.appendChild(imageElement);
                });
                modal.style.display = 'block';
            });
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
    </script>
</body>
</html>
