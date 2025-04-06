<?php
session_start();
if (!isset($_SESSION['users_id'])) {
    header("Location: home.php"); 
    exit();
}
$user_name = isset($_SESSION['users_name']) ? $_SESSION['users_name'] : "Guest";
?>
<!DOCTYPE html>
<html lang="en">

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

        <h1>About Us</h1>
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
    <span>Why Choose Us?</span>
    <h3>Nature's Beauty Awaits You</h3>
    <p>Discover Morocco's enchanting cities and explore their rich history! Join us on an unforgettable journey where tradition meets modernity, and natural beauty blends with cultural heritage.</p>
    
    <div class="stats">
        <div class="stat-item">
            <h4>5000+</h4>
            <p>Satisfied Tourists</p>
        </div>
        <div class="stat-item">
            <h4>10+</h4>
            <p>Years of Experience</p>
        </div>
        <div class="stat-item">
            <h4>100+</h4>
            <p>Tour Destinations Across Morocco</p>
        </div>
    </div>
    
    <a href="#contact" class="cta-btn">Book Your Tour Now</a>
</div>

    </section>
    <section class="reviews">
    <?php

require 'db.php';

// Fetch reviews from the database
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
            <p>My Morocco trip was amazing thanks to the Moroccan Tourism Agency...</p>
            <h3>John Deo</h3>
            <span>2024-01-09   10:23:30</span>
        </div>
        <div class="review-card">
            <div class="stars">
                 <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </div>
            <p>I commend the Moroccan Tourism Agency for organizing my trip...</p>
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
            <p>The experience was unforgettable, from the landscapes to the local culture...</p>
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
            <p>A decent experience, but some improvements could be made...</p>
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
            <p>I had a wonderful time discovering Morocco’s beauty...</p>
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