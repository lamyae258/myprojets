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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include('navbar.php'); ?>
<button id="scrollToTopBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>

    <div class="headingg" style="background: url(image/about.png) no-repeat;"></div>
    <section class="home active" id="home">

        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar2.jpg) no-repeat;">
                    <div class="content">
                        <span>Explorez le Maroc, découvrez la beauté.</span>
                        <h3>Le Maroc de vos rêves, où les souvenirs ne s’effacent jamais.</h3>
                      <a href="booking.php" class="btn">Réserver </a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar1.jpg) no-repeat;">
                    <div class="content">
                        <span>Explorez le Maroc, découvrez la beauté.</span>
                        <h3>Rêves du Maroc, souvenirs inoubliables.</h3>
                     <a href="booking.php" class="btn">Réserver </a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar3.jpg) no-repeat;">
                    <div class="content">
                        <span>Explorez le Maroc, découvrez la beauté.</span>
                        <h3>Le Maroc : là où les rêves rencontrent des moments inoubliables.</h3>
                        <a href="booking.php" class="btn">Réserver </a>
                    </div>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

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
            <span>Pourquoi nous choisir ?</span>
            <h3>La majesté de la nature vous attend</h3>
            <p>Découvrez les villes captivantes du Maroc et plongez dans leur riche histoire ! Rejoignez-nous pour un voyage inoubliable où tradition et modernité se rencontrent, et où la beauté naturelle se mêle au patrimoine culturel.</p>
            <a href="about.php" class="btn">Lire plus</a>
        </div>
    </section>

    <?php
    include 'db.php';
    try {
        $query = "SELECT * FROM services";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
    <section class="services" id="services">
        <h2 class="section-title">Nos Services</h2>
        <div class="services-container">
            <?php foreach ($services as $service) { ?>
                <div class="service-box">
                    <div class="service-front">
                        <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                        <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                    </div>
                    <div class="service-back">
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="special-offers" id="special-offers">
        <h2 class="section-title">Nos Offres Spéciales</h2>
        <div class="offers-container">
            <div class="offer-box">
                <h3>Offre Spéciale Printemps</h3>
                <p>Profitez de 20 % de réduction sur toutes les excursions ce printemps.</p>
                <button class="btn" onclick="showBookingForm('spring-trip')">Réserver</button>
            </div>
            <div class="offer-box">
                <h3>Hôtel + Visite Gratuite</h3>
                <p>Réservez un hôtel et profitez d’une visite guidée gratuite.</p>
                <button class="btn" onclick="showBookingForm('hotel-tour')">Réserver</button>
            </div>
            <div class="offer-box">
                <h3>Forfait Famille</h3>
                <p>Réductions spéciales pour les voyages en famille. Réservez maintenant pour des vacances inoubliables.</p>
                <button class="btn" onclick="showBookingForm('family-package')">Réserver</button>
            </div>
            <div class="offer-box">
                <h3>Tours VIP Exclusifs</h3>
                <p>Réservez un tour VIP pour une expérience de voyage exclusive avec des avantages supplémentaires.</p>
                <button class="btn" onclick="showBookingForm('vip-tour')">Réserver</button>
            </div>
            <div class="offer-box">
                <h3>Escapade de Week-end</h3>
                <p>Évadez-vous le temps d’un week-end à des tarifs réduits.</p>
                <button class="btn" onclick="showBookingForm('weekend-getaway')">Réserver</button>
            </div>
            <div class="offer-box">
                <h3>Aventure dans le désert</h3>
                <p>Vivez une aventure inoubliable dans le désert avec des réductions exclusives.</p>
                <button class="btn" onclick="showBookingForm('desert-adventure')">Réserver</button>
            </div>
        </div>

        <div id="booking-form" style="display:none;">
            <h3>Formulaire de Réservation</h3>
            <form action="#" id="bookinf-form">
                <label for="offer-type">Choisissez une offre :</label>
                <select id="offer-type">
                    <option id="spring-trip" value="Offre Spéciale Printemps">Offre Spéciale Printemps</option>
                    <option id="hotel-tour" value="Hôtel + Visite Gratuite">Hôtel + Visite Gratuite</option>
                    <option id="family-package" value="Forfait Famille">Forfait Famille</option>
                    <option id="vip-tour" value="Tours VIP Exclusifs">Tours VIP Exclusifs</option>
                    <option id="weekend-getaway" value="Escapade de Week-end">Escapade de Week-end</option>
                    <option id="desert-adventure" value="Aventure dans le désert">Aventure dans le désert</option>
                </select>
                <br><br>
                <label for="name">Nom complet :</label>
                <input type="text" id="name" name="name" required style=" text-transform: lowercase;">
                <br><br>
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required style=" text-transform: lowercase;">
                <br><br>
                <button type="submit" class="btn">Envoyer</button>
                <button class="btn" onclick="closeBookingForm()">Fermer</button>
            </form>
            <div id="response-message"></div>
        </div>
    </section>

    <section class="faq" id="faq">
        <h2 class="section-title">Foire Aux Questions</h2>
        <div class="faq-container">
            <div class="faq-item">
                <h3 class="faq-question">Comment puis-je réserver un voyage ?</h3>
                <p class="faq-answer">Vous pouvez réserver votre voyage via notre site web ou en contactant notre équipe directement.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Puis-je modifier ma réservation après confirmation ?</h3>
                <p class="faq-answer">Oui, vous pouvez la modifier en nous contactant au moins 24 heures avant le voyage.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Les prix incluent-ils tous les frais ?</h3>
                <p class="faq-answer">Oui, les prix incluent tous les frais initiaux, sauf les charges supplémentaires spéciales.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Comment annuler ma réservation ?</h3>
                <p class="faq-answer">Vous pouvez annuler votre réservation au moins 48 heures avant le départ pour un remboursement complet.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Y a-t-il des frais cachés ?</h3>
                <p class="faq-answer">Non, nous prônons la transparence. Tous les frais sont clairement indiqués lors de la réservation.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Puis-je obtenir un remboursement ?</h3>
                <p class="faq-answer">Les remboursements sont possibles selon notre politique d’annulation. Consultez nos conditions générales pour plus de détails.</p>
            </div>
        </div>
    </section>

    <?php include 'footer.php'?>

    <script src="javascript/home.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
