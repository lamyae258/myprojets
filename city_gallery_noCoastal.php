<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header("Location: home.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '512M');
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '64M');

require 'db.php';

$citySlug = isset($_GET['city_slug']) ? $_GET['city_slug'] : '';

$sql = "SELECT * FROM non_coastal_cities WHERE city_slug = :city_slug";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':city_slug', $citySlug);
$stmt->execute();
$city = $stmt->fetch(PDO::FETCH_ASSOC);

if ($city) {
    $cityName = $city['city_name'];
} else {
    echo "City not found.";
    exit();
}

$sqlImages = "SELECT * FROM city_images_nocoastal WHERE city_id = :city_id";
$stmtImages = $pdo->prepare($sqlImages);
$stmtImages->bindParam(':city_id', $city['city_id']);
$stmtImages->execute();
$images = $stmtImages->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery of <?= htmlspecialchars($cityName) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">

<section class="images_cities">
    <h2 class="h2"><?= htmlspecialchars($cityName) ?></h2>

    <div class="gallery">
        <?php if ($images): ?>
            <?php foreach ($images as $image): ?>
                <div id="fade-in">
                <img src="<?= htmlspecialchars($image['image_path']) ?>" alt="<?= htmlspecialchars($cityName) ?> " >
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images for this city.</p>
        <?php endif; ?>
    </div>
</section>

<script>
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top >= 0 && rect.bottom <= window.innerHeight;
    }

    function handleScroll() {
        const fadeInElements = document.querySelectorAll('#fade-in');

        fadeInElements.forEach(function (el) {
            if (isElementInViewport(el)) {
                el.classList.add('visible');
            }
        });
    }
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('load', handleScroll);
</script>
</body>
</html>

<?php
$pdo = null;
?>
