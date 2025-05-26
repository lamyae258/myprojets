<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['city_id']) && !empty($_FILES['city_image']['name'])) {
        $cityId = $_POST['city_id'];
        $sql = "SELECT city_slug, city_name FROM coastal_cities WHERE city_id = :city_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':city_id', $cityId);
        $stmt->execute();
        $city = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($city) {
            $citySlug = $city['city_slug'];
            $cityName = $city['city_name'];
            $imagePath = __DIR__ . "/../uploadeAdmin/" . basename($_FILES["city_image"]["name"]);
            $dbImagePath = "/../uploadeAdmin/" . basename($_FILES["city_image"]["name"]);

            if (move_uploaded_file($_FILES["city_image"]["tmp_name"], $imagePath)) {
                $sql = "INSERT INTO city_images (city_id, city_slug, image_path) VALUES (:city_id, :city_slug, :image_path)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':city_id', $cityId);
                $stmt->bindParam(':city_slug', $citySlug);
                $stmt->bindParam(':image_path', $dbImagePath);
                $stmt->execute();
            }
        } else {
            echo "⚠️ Ville non trouvée.";
        }
    } else {
        echo "⚠️ ID de la ville ou image non spécifiés.";
    }
}

if (isset($_GET['delete_image_id'])) {
    $deleteImageId = $_GET['delete_image_id'];

    $sql = "SELECT image_path FROM city_images WHERE image_id = :image_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':image_id', $deleteImageId);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $imagePath = __DIR__ . "/../" . $image['image_path'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $sqlDelete = "DELETE FROM city_images WHERE image_id = :image_id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':image_id', $deleteImageId);
        $stmtDelete->execute();

        echo "✅ Image supprimée avec succès !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gérer les Images des Villes</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<form method="POST" enctype="multipart/form-data" class="form-gallery">
    <select name="city_id" required>
        <option value="">Sélectionner une ville</option>
        <?php
        $sql = "SELECT * FROM coastal_cities";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cities as $city) {
            echo '<option value="' . $city['city_id'] . '">' . htmlspecialchars($city['city_name']) . '</option>';
        }
        ?>
    </select>
    <input type="file" name="city_image" required>
    <button type="submit">Téléverser l’image</button>
</form>

<h3>Images de la ville :</h3>
<?php
if (!empty($_GET['city_id'])) {
    $cityId = $_GET['city_id'];

    $sql = "SELECT * FROM city_images WHERE city_id = :city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':city_id', $cityId);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($images): ?>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($images as $index => $image): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <img src="../<?= htmlspecialchars($image['image_path']) ?>" alt="Image" style="width: 150px; height: 100px; object-fit: cover;">
                        </td>
                        <td>
                            <a href="?delete_image_id=<?= $image['image_id'] ?>&city_id=<?= $cityId ?>" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')" 
                                style="color: red; text-decoration: none; background-color: #f8d7da; padding: 5px 10px; border-radius: 5px;">
                                ❌ Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune image trouvée pour cette ville.</p>
    <?php endif;
}
?>

<h3>Images récemment ajoutées :</h3>
<?php
$sql = "SELECT * FROM city_images ORDER BY image_id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$recentImages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($recentImages): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 20px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Ville</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentImages as $index => $image): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <?php
                        $sqlCity = "SELECT city_name FROM coastal_cities WHERE city_id = :city_id";
                        $stmtCity = $pdo->prepare($sqlCity);
                        $stmtCity->bindParam(':city_id', $image['city_id']);
                        $stmtCity->execute();
                        $city = $stmtCity->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($city['city_name']);
                        ?>
                    </td>
                    <td>
                        <img src="../<?= htmlspecialchars($image['image_path']) ?>" alt="Image" style="width: 150px; height: 100px; object-fit: cover;">
                    </td>
                    <td>
                        <a href="?delete_image_id=<?= $image['image_id'] ?>" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')" 
                            style="color: red; text-decoration: none; background-color: #f8d7da; padding: 5px 10px; border-radius: 5px;">
                            ❌ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucune image récente trouvée.</p>
<?php endif; ?>

</body>
</html>
