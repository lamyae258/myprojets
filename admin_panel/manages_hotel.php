<?php
require 'db.php';
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM hotels WHERE hotel_id = ?");
    $stmt->execute([$id]);
    header("Location:manages_hotel.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotelName = $_POST['hotel_name'];
    $cityId = $_POST['city_id'];
    $stars = $_POST['stars'];
    $price = $_POST['price_per_night'];
    $location = $_POST['location'];
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadDir = 'uploadeAdmin/hotels/';
    move_uploaded_file($imageTmp, $uploadDir . $imageName);
    $stmt = $pdo->prepare("INSERT INTO hotels (city_id, hotel_name, stars, price_per_night, location, image_path)
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$cityId, $hotelName, $stars, $price, $location, $imageName]);
    header("Location: manages_hotel.php");
    exit;
}
// Récupérer les villes
$cities = $pdo->query("SELECT * FROM coastal_cities")->fetchAll(PDO::FETCH_ASSOC);
// Récupérer les hôtels
$sql = "SELECT hotels.*, coastal_cities.city_name 
        FROM hotels 
        JOIN coastal_cities ON hotels.city_id = coastal_cities.city_id";
$hotels = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panneau d'administration des hôtels</title>
    <link rel="stylesheet" href="admin.css">

</head>
<body>

<h2> Ajouter un nouvel hôtel</h2>

<form action="" method="post" enctype="multipart/form-data" class="manage_hotel">
    <label>Nom de l'hôtel :</label>
    <input type="text" name="hotel_name" required>

    <label>Ville :</label>
    <select name="city_id" required>
        <?php foreach ($cities as $city): ?>
            <option value="<?= $city['city_id'] ?>"><?= htmlspecialchars($city['city_name']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Étoiles (1-5) :</label>
    <input type="number" name="stars" min="1" max="5" required>

    <label>Prix par nuit (MAD) :</label>
    <input type="number" step="0.01" name="price_per_night" required>

    <label>Emplacement :</label>
    <input type="text" name="location" required>

    <label>Image :</label>
    <input type="file" name="image" required>

    <input class="sub" type="submit" value="Ajouter l'hôtel">
</form>

<h2> Liste des hôtels</h2>
<table class="table">
    <tr>
        <th>Image</th>
        <th>Nom</th>
        <th>Ville</th>
        <th>Étoiles</th>
        <th>Prix</th>
        <th>Emplacement</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($hotels as $hotel): ?>
    <tr>
        <td><img src="http://localhost/myprojet/uploadeAdmin/hotels/<?= htmlspecialchars($hotel['image_path']) ?>" alt="Image de l'hôtel"></td>
        <td><?= htmlspecialchars($hotel['hotel_name']) ?></td>
        <td><?= htmlspecialchars($hotel['city_name']) ?></td>
        <td><?= htmlspecialchars($hotel['stars']) ?> ⭐</td>
        <td><?= htmlspecialchars($hotel['price_per_night']) ?> MAD</td>
        <td><?= htmlspecialchars($hotel['location']) ?></td>
        <td class="actions">
            <a href="?delete=<?= $hotel['hotel_id'] ?>" onclick="return confirm('Supprimer cet hôtel ?')"> Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
