<?php
require 'db.php';
$sql = "SELECT h.*, c.city_name FROM hotels h JOIN coastal_cities c ON h.city_id = c.city_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Hotels</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<video src="image/about-vid-1.mp4" autoplay muted loop class="videoo"></video>
<div class="hotels-container">
    <?php foreach ($hotels as $hotel): ?>
        <div class="hotel-card">
            <div class="hotel-inner">
                <img src="http://localhost/myprojet/uploadeAdmin/hotels/<?= htmlspecialchars($hotel['image_path']) ?>" alt="Hotel Image">
                <div class="hotel-info">
                    <h3><?= htmlspecialchars($hotel['hotel_name']) ?></h3>
                    <p><strong>City:</strong> <?= htmlspecialchars($hotel['city_name']) ?></p>
                    <p><strong>Stars:</strong> <?= htmlspecialchars($hotel['stars']) ?>⭐</p>
                    <p><strong>Price:</strong> <?= htmlspecialchars($hotel['price_per_night']) ?> MAD per night</p>
                    <p><strong>Location:</strong> <?= htmlspecialchars($hotel['location']) ?></p>

                    <button class="view-images-btn" onclick="showImages(<?= $hotel['hotel_id'] ?>)">View Images</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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
