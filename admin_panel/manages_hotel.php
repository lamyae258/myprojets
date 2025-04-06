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
// جلب المدن
$cities = $pdo->query("SELECT * FROM coastal_cities")->fetchAll(PDO::FETCH_ASSOC);
// جلب الفنادق
$sql = "SELECT hotels.*, coastal_cities.city_name 
        FROM hotels 
        JOIN coastal_cities ON hotels.city_id = coastal_cities.city_id";
$hotels = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Hotels Panel</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { margin-bottom: 10px; }
        form { margin-bottom: 30px; border: 1px solid #ccc; padding: 20px; border-radius: 10px; max-width: 600px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: center; }
        img { max-width: 100px; border-radius: 5px; }
        .actions a { margin: 0 5px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<h2>➕ Add New Hotel</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label>Hotel Name:</label>
    <input type="text" name="hotel_name" required>

    <label>City:</label>
    <select name="city_id" required>
        <?php foreach ($cities as $city): ?>
            <option value="<?= $city['city_id'] ?>"><?= htmlspecialchars($city['city_name']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Stars (1-5):</label>
    <input type="number" name="stars" min="1" max="5" required>

    <label>Price per Night (MAD):</label>
    <input type="number" step="0.01" name="price_per_night" required>

    <label>Location:</label>
    <input type="text" name="location" required>

    <label>Image:</label>
    <input type="file" name="image" required>

    <input type="submit" value="Add Hotel">
</form>

<h2>🏨 Hotel List</h2>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>City</th>
        <th>Stars</th>
        <th>Price</th>
        <th>Location</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($hotels as $hotel): ?>
    <tr>
        <td><img src="http://localhost/myprojet/uploadeAdmin/hotels/<?= htmlspecialchars($hotel['image_path']) ?>" alt="Hotel Image"></td>
        <td><?= htmlspecialchars($hotel['hotel_name']) ?></td>
        <td><?= htmlspecialchars($hotel['city_name']) ?></td>
        <td><?= htmlspecialchars($hotel['stars']) ?> ⭐</td>
        <td><?= htmlspecialchars($hotel['price_per_night']) ?> MAD</td>
        <td><?= htmlspecialchars($hotel['location']) ?></td>
        <td class="actions">
            <a href="?delete=<?= $hotel['hotel_id'] ?>" onclick="return confirm('Delete this hotel?')">🗑️ Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
