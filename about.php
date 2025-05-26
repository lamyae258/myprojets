<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header("Location: home.php"); 
    exit();
}
$user_name = isset($_SESSION['users_name']) ? $_SESSION['users_name'] : "Invité";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php include('navbar.php'); ?>
    <div class="heading" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/about.jpg) no-repeat;">

        <h1>À propos de nous</h1>
    </div>

    <section class="about" id="about">
        <div class="video-container">
            <video src="image/about-vid-1.mp4" autoplay muted loop class="video"></video>
            <div class="controls">
                <span class="control-btn" data-src="image/about-vid-1.mp4"></span>
                <span class="control-btn" data-src="image/about-vid-2.mp4"></span>
                <span class="control-btn" data-src="image/about-vid-3.mp4"></span>
            </div>
        </div>
        <div class="content">
    <span>Pourquoi choisir notre agence ?</span>
    <h3>La beauté de la nature vous attend</h3>
    <p>Découvrez les villes envoûtantes du Maroc et explorez leur histoire riche ! Rejoignez-nous pour un voyage inoubliable où tradition et modernité se rencontrent, et où la beauté naturelle se mêle au patrimoine culturel.</p>
    
    <div class="stats">
        <div class="stat-item">
            <h4>5000+</h4>
            <p>Touristes satisfaits</p>
        </div>
        <div class="stat-item">
            <h4>10+</h4>
            <p>Années d'expérience</p>
        </div>
        <div class="stat-item">
            <h4>100+</h4>
            <p>Destinations touristiques à travers le Maroc</p>
        </div>
    </div>
    
    <a href="booking.php" class="cta-btn">Réservez  maintenant</a>
</div>

    </section>
    <section class="reviews">
    <?php

require 'db.php';

// Récupérer les avis depuis la base de données
$sql = "SELECT r.rating, r.comment, r.created_at, u.name 
        FROM reviews r
        JOIN users u ON r.users_id = u.users_id
        ORDER BY r.created_at DESC";
$stmt = $pdo->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="reviews-container">
    <div class="reviews-slider" id="reviews-slider">
        <div class="review-card">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Mon voyage au Maroc était incroyable grâce à l'agence de tourisme marocaine...</p>
            <h3>John Deo</h3>
            <span>2024-01-09   10:23:30</span>
        </div>
        <div class="review-card">
            <div class="stars">
                 <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </div>
            <p>Je félicite l'agence de tourisme marocaine pour l'organisation de mon voyage...</p>
            <h3>Anna</h3>
            <span>2024-02-19   18:23:30</span>
        </div>
        <div class="review-card">
            <div class="stars">
            <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                
            </div>
            <p>L'expérience était inoubliable, des paysages à la culture locale...</p>
            <h3>Sam</h3>
            <span>2024-05-29   01:13:22</span>
        </div>
        <div class="review-card">
            <div class="stars">
            <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Une expérience correcte, mais quelques améliorations pourraient être apportées...</p>
            <h3>Emily</h3>
            <span>2024-11-23   10:02:38</span>
        </div>
        <div class="review-card">
            <div class="stars">
            <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>J'ai passé un moment merveilleux à découvrir la beauté du Maroc...</p>
            <h3>Michael</h3>
            <span>2025-01-09   12:30:30</span>
        </div>
        <?php
        
            foreach ($reviews as $review) {
                echo '<div class="review-card">';
                echo '<div class="stars">';
                
             
            
                for ($i = 0; $i < $review['rating']; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                for ($i = $review['rating']; $i < 5; $i++) {
                    echo '<i class="far fa-star"></i>';
                }

                echo '</div>';
                echo '<p>' . htmlspecialchars($review['comment']) . '</p>';
                echo '<h3>' . htmlspecialchars($review['name']) . '</h3>';
                echo '<span>' . $review['created_at'] . '</span>';
                echo '</div>';
            }
        ?>
    </div>
    <button id="prevBtn" class="slider-btn"><</button>
    <button id="nextBtn" class="slider-btn">></button>
</div>

    <form id="reviewForm" action="reviews.php" method="post">

        <label for="rating">Note :</label>
        <select id="rating" name="rating" required>
            <option value="5">5 étoiles</option>
            <option value="4">4 étoiles</option>
            <option value="3">3 étoiles</option>
            <option value="2">2 étoiles</option>
            <option value="1">1 étoile</option>
        </select>

        <label for="content">Commentaire :</label>
        <textarea id="content" name="content" placeholder="Votre avis ici..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</section>


<?php include 'footer.php'?>


    <script src="javascript/about.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</body>

</html>
