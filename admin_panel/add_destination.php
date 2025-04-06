<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require '../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_city'])) {
    $cityName = $_POST['city_name'];
    $cityDescription = $_POST['city_description'];
    $citySlug = strtolower(str_replace(' ', '-', $cityName));
    
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/lamyae/uploadeAdmin/";
    $fileName = basename($_FILES["city_image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png'];
    if (getimagesize($_FILES["city_image"]["tmp_name"]) === false || !in_array($imageFileType, $allowedTypes)) {
        echo "❌ The file is not a valid image.";
        exit();
    }
    if (!move_uploaded_file($_FILES["city_image"]["tmp_name"], $targetFile)) {
        echo "❌ An error occurred while uploading the image.";
        exit();
    }
    
    $imagePath = "/myprojet/uploadeAdmin/" . $fileName;
    
    $sql = "INSERT INTO coastal_cities (city_name, city_slug, city_description, city_image) 
            VALUES (:city_name, :city_slug, :city_description, :city_image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':city_name' => $cityName,
        ':city_slug' => $citySlug,
        ':city_description' => $cityDescription,
        ':city_image' => $imagePath
    ]);

    echo "✅ City added successfully!";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_city'])) {
    $cityId = $_POST['city_id'];

    $sql = "SELECT city_image FROM coastal_cities WHERE city_id = :city_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':city_id' => $cityId]);
    $city = $stmt->fetch();

    if ($city) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $city['city_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $sqlDelete = "DELETE FROM coastal_cities WHERE city_id = :city_id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->execute([':city_id' => $cityId]);

        echo "✅ City deleted successfully!";
    }
}

// 🔎 Fetch Data
$sql = "SELECT * FROM coastal_cities";
$stmt = $pdo->query($sql);
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Coastal Cities</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    
    <form action="" method="POST" enctype="multipart/form-data" class="form-destination">
    <h2>Add Coastal City</h2>
        <label>City Name:</label>
        <input type="text" name="city_name" required><br>
        <label>City Description:</label>
        <textarea name="city_description" required></textarea><br>
        <label>City Image:</label>
        <input type="file" name="city_image" required><br>
        <button type="submit" name="add_city">Add</button>
    </form>

    <h2>List of Coastal Cities</h2>
    <table border="1">
        <tr>
            <th>City Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Image</th>
            <th>Delete</th>
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
                    <button type="submit" name="delete_city" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
