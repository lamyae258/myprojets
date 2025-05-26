<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['hotel_images'])) {
    $hotel_id = $_POST['hotel_id']; 
    $images = $_FILES['hotel_images'];
    $upload_dir = "./uploadeAdmin"; 
    foreach ($images['tmp_name'] as $index => $tmp_name) {
        $file_name = basename($images['name'][$index]);
        $file_path = $upload_dir . $file_name;
        if (move_uploaded_file($tmp_name, $file_path)) {
            
            $sql = "INSERT INTO hotel_images (hotel_id, image_path) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$hotel_id, $file_name]);
        }
    }
}
$sql = "SELECT hotel_id, hotel_name FROM hotels";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter des images à un hôtel</title>
</head>
<body>

<h2>Ajouter des images à un hôtel</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="hotel_id">Sélectionner un hôtel :</label>
    <select name="hotel_id" id="hotel_id" required>
        <option value="">Choisir un hôtel</option>
        <?php foreach ($hotels as $hotel): ?>
            <option value="<?= $hotel['hotel_id'] ?>"><?= htmlspecialchars($hotel['hotel_name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="hotel_images">Télécharger des images :</label>
    <input type="file" name="hotel_images[]" id="hotel_images" multiple required><br><br>

    <button type="submit">Ajouter les images</button>
</form>

</body>
</html>
