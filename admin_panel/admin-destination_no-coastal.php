<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require '../db.php';

// إضافة مدينة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_city'])) {
    $cityName = $_POST['city_name'];
    $cityDescription = $_POST['city_description'];
    $citySlug = strtolower(str_replace(' ', '-', $cityName));
    
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/myprojet/uploadeAdmin/"; 
    $fileName = basename($_FILES["city_image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $allowedTypes = ['jpg', 'jpeg', 'png','webp'];
    if (getimagesize($_FILES["city_image"]["tmp_name"]) === false || !in_array($imageFileType, $allowedTypes)) {
        echo "Type de fichier invalide.";
        exit();
    }
    
    if (!move_uploaded_file($_FILES["city_image"]["tmp_name"], $targetFile)) {
        echo "Erreur lors du téléchargement du fichier.";
        exit();
    }
    
    $imagePath = "/myprojet/uploadeAdmin/" . $fileName;
    
    $sql = "INSERT INTO non_coastal_cities (city_name, city_slug, city_description, city_image) 
            VALUES (:city_name, :city_slug, :city_description, :city_image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':city_name' => $cityName,
        ':city_slug' => $citySlug,
        ':city_description' => $cityDescription,
        ':city_image' => $imagePath
    ]);

    echo "Ville ajoutée avec succès.";
}

// حذف مدينة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_city'])) {
    $cityId = $_POST['city_id'];

    // حذف الصور المرتبطة أولاً
    $deleteImages = $pdo->prepare("SELECT image_path FROM city_images_nocoastal WHERE city_id = :city_id");
    $deleteImages->execute([':city_id' => $cityId]);
    $images = $deleteImages->fetchAll();

    foreach ($images as $img) {
        $imgPath = $_SERVER['DOCUMENT_ROOT'] . $img['image_path'];
        if (file_exists($imgPath)) {
            unlink($imgPath); // حذف الصورة من السيرفر
        }
    }

    // حذف الصور من جدول city_images_nocoastal
    $stmtDeleteImages = $pdo->prepare("DELETE FROM city_images_nocoastal WHERE city_id = :city_id");
    $stmtDeleteImages->execute([':city_id' => $cityId]);

    // جلب وحذف صورة المدينة الرئيسية
    $sql = "SELECT city_image FROM non_coastal_cities WHERE city_id = :city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':city_id' => $cityId]);
    $city = $stmt->fetch();

    if ($city) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $city['city_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // حذف المدينة
        $sqlDelete = "DELETE FROM non_coastal_cities WHERE city_id = :city_id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->execute([':city_id' => $cityId]);

        echo "Ville supprimée avec succès.";
    }
}

// جلب المدن
$sql = "SELECT * FROM non_coastal_cities";
$stmt = $pdo->query($sql);
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Villes Non-Sociales</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    
    <form action="" method="POST" enctype="multipart/form-data" class="form-destination">
       <h2>Ajouter une Ville Non-Sociale</h2>
        <label>Nom de la Ville :</label>
        <input type="text" name="city_name" required><br>
        <label>Description de la Ville :</label>
        <textarea name="city_description" required></textarea><br>
        <label>Image de la Ville :</label>
        <input type="file" name="city_image" required><br>
        <button type="submit" name="add_city">Ajouter</button>
    </form>

    <h2>Liste des Villes Non-Sociales</h2>
    <table border="1">
        <tr>
            <th>Nom de la Ville</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Image</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach ($cities as $city): ?>
        <tr>
            <td><?= htmlspecialchars($city['city_name']) ?></td>
            <td><?= htmlspecialchars($city['city_slug']) ?></td>
            <td><?= htmlspecialchars($city['city_description']) ?></td>
            <td>
                <img src="<?= $city['city_image'] ?>" alt="<?= htmlspecialchars($city['city_name']) ?>" width="100">
            </td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="city_id" value="<?= $city['city_id'] ?>">
                    <button type="submit" name="delete_city" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
