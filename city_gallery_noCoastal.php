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
    echo "Ville introuvable.";
    exit();
}

$sqlImages = "SELECT * FROM city_images_nocoastal WHERE city_id = :city_id";
$stmtImages = $pdo->prepare($sqlImages);
$stmtImages->bindParam(':city_id', $city['city_id']);
$stmtImages->execute();
$images = $stmtImages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie photos de <?= htmlspecialchars($cityName) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        .images_cities {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }

        .h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hotl {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .intro-text {
            font-size: 1.1rem;
            text-align: center;
            color: #444;
            margin-bottom: 25px;
            font-style: italic;
        }

        .divider {
            width: 60px;
            height: 3px;
            background-color: #3498db;
            border: none;
            margin: 0 auto 20px auto;
        }

        .image-count {
            font-size: 0.95rem;
            color: #777;
            text-align: center;
            margin-bottom: 25px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(298px, 29fr));
            gap: 25px;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .fade-in img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            .h2 {
                font-size: 1.8rem;
            }

            .btn {
                padding: 10px 18px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body class="body">

<section class="images_cities">
    <h2 class="h2"><?= htmlspecialchars($cityName) ?></h2>

    <div class="hotl">
        <a href="hotels.php?city_slug=<?= urlencode($citySlug) ?>" class="btn">Hôtels</a>
    </div>

    <p class="intro-text">
        Découvrez les plus belles vues de <?= htmlspecialchars($cityName) ?> à travers notre galerie exclusive.
    </p>

    <hr class="divider">

    <p class="image-count"><?= count($images) ?> photo(s) disponible(s) pour <?= htmlspecialchars($cityName) ?>.</p>

    <div class="gallery">
        <?php if ($images): ?>
            <?php foreach ($images as $image): ?>
                <div class="fade-in">
                    <img src="/myprojet/<?= htmlspecialchars($image['image_path']) ?>" alt="Image de <?= htmlspecialchars($cityName) ?>">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune image disponible pour cette ville.</p>
        <?php endif; ?>
    </div>
</section>

<script>
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top >= 0 && rect.bottom <= window.innerHeight;
    }

    function handleScroll() {
        const fadeInElements = document.querySelectorAll('.fade-in');

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

<?php $pdo = null; ?>
