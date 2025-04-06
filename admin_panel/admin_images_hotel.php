<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['hotel_images'])) {
    $hotel_id = $_POST['hotel_id'];  // Make sure you have hotel_id to link images to the hotel
    $images = $_FILES['hotel_images'];

    // Directory path for uploading images
    $upload_dir = "./uploadeAdmin"; 

    // Upload each image
    foreach ($images['tmp_name'] as $index => $tmp_name) {
        $file_name = basename($images['name'][$index]);
        $file_path = $upload_dir . $file_name;

        // Move the image to the correct directory
        if (move_uploaded_file($tmp_name, $file_path)) {
            // Add the image path to the database
            $sql = "INSERT INTO hotel_images (hotel_id, image_path) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$hotel_id, $file_name]);
        }
    }
}

// Retrieve all hotels from the database
$sql = "SELECT hotel_id, hotel_name FROM hotels";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Hotel Images</title>
</head>
<body>

<h2>Add Images to a Hotel</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="hotel_id">Select a hotel:</label>
    <select name="hotel_id" id="hotel_id" required>
        <option value="">Choose a hotel</option>
        <?php foreach ($hotels as $hotel): ?>
            <option value="<?= $hotel['hotel_id'] ?>"><?= htmlspecialchars($hotel['hotel_name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="hotel_images">Upload images:</label>
    <input type="file" name="hotel_images[]" id="hotel_images" multiple required><br><br>

    <button type="submit">Add Images</button>
</form>

</body>
</html>
