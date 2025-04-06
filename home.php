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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include('navbar.php'); ?>
    <div class="headingg" style="background: url(image/about.png) no-repeat;"></div>
    <section class="home active" id="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar2.jpg) no-repeat;">
                    <div class="content">
                        <span>Explore Morocco, Discover Beauty.</span>
                        <h3>Morocco of Dreams, Where Memories Never Fade.</h3>
                        <a href="package.html" class="btn"> discouver more</a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar1.jpg) no-repeat;">
                    <div class="content">
                        <span>Explore Morocco, Discover Beauty.</span>
                        <h3>Dreams of Morocco, Unforgettable Memories.</h3>
                        <a href="package.html" class="btn"> discouver more</a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/mar3.jpg) no-repeat;">
                    <div class="content">
                        <span>Explore Morocco, Discover Beauty.</span>
                        <h3>Morocco: Where Dreams Meet Unforgettable Moments.</h3>
                        <a href="package.html" class="btn"> discouver more</a>
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
            <span>Why Choose Us?</span>
            <h3>Nature's Majesty Awaits You</h3>
            <p>Discover Morocco's captivating cities and delve into their rich history! Join us on an unforgettable journey where tradition meets modernity and natural beauty blends with cultural heritage.</p>
            <a href="about.php" class="btn">Read More</a>
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
    echo "Error: " . $e->getMessage();
}

?>

<section class="services" id="services">
    <h2 class="section-title">Our Services</h2>
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
        
        <h2 class="section-title">Our Special Offers</h2>
        <div class="offers-container">
           
            <div class="offer-box">
                <h3>Spring Trip Special Offer</h3>
                <p>Enjoy a 20% discount on all tourist trips this spring.</p>
                <button class="btn" onclick="showBookingForm('spring-trip')">BookNow</button>
            </div>
            <div class="offer-box">
                <h3>Hotel Booking + Free Tour</h3>
                <p>Book a hotel and get a free sightseeing tour.</p>
                <button class="btn" onclick="showBookingForm('hotel-tour')">BookNow</button>
            </div>
            <div class="offer-box">
                <h3>Family Package Deal</h3>
                <p>Special discounts for family trips. Book now for a memorable vacation.</p>
                <button class="btn" onclick="showBookingForm('family-package')">BookNow</button>
            </div>
            <div class="offer-box">
                <h3>Exclusive VIP Tours</h3>
                <p>Book a VIP tour for an exclusive travel experience with added perks.</p>
                <button class="btn" onclick="showBookingForm('vip-tour')">BookNow</button>
            </div>
            <div class="offer-box">
                <h3>Weekend Getaway</h3>
                <p>Escape for a relaxing weekend trip at discounted rates.</p>
                <button class="btn" onclick="showBookingForm('weekend-getaway')">BookNow</button>
            </div>
           
            <div class="offer-box">
                <h3>Adventure in the Desert</h3>
                <p>Experience an unforgettable desert adventure with exclusive discounts.</p>
                <button class="btn" onclick="showBookingForm('desert-adventure')">BookNow</button>
            </div>
        </div>

        <div id="booking-form" style="display:none;">
            <h3>Booking Form</h3>
            <form action="#" id="bookinf-form">
                <label for="offer-type">Choose an offer:</label>
                <select id="offer-type">
                    <option id="spring-trip" value="Spring Trip Special Offer">Spring Trip Special Offer</option>
                    <option id="hotel-tour" value="Hotel Booking + Free Tour">Hotel Booking + Free Tour</option>
                    <option id="family-package" value="Family Package Deal">Family Package Deal</option>
                    <option id="vip-tour" value="Exclusive VIP Tours">Exclusive VIP Tours</option>
                    <option id="weekend-getaway" value="Weekend Getaway">Weekend Getaway</option>
                    <option id="desert-adventure" value="Adventure in the Desert">Adventure in the Desert</option> <!-- New Option -->
                </select>
                <br><br>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required style=" text-transform: lowercase;">
                <br><br>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required style=" text-transform: lowercase;">
                <br><br>
                <button type="submit" class="btn">Submit</button>
                <button class="btn" onclick="closeBookingForm()">Close</button>
            </form>
            <div id="response-message"></div>
        </div>
    </section>

    <section class="faq" id="faq">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-container">
            <div class="faq-item">
                <h3 class="faq-question">How can I book a trip?</h3>
                <p class="faq-answer">You can book your trip through our website or by contacting our team directly.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Can I modify my booking after confirmation?</h3>
                <p class="faq-answer">Yes, you can modify your booking by contacting us at least 24 hours before the trip.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Do the prices include all costs?</h3>
                <p class="faq-answer">Yes, the prices we provide include all initial costs, excluding any additional special charges.</p>
            </div>

            <div class="faq-item">
                <h3 class="faq-question">How do I cancel my booking?</h3>
                <p class="faq-answer">You can cancel your booking by contacting us at least 48 hours before your trip for a full refund.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Are there any hidden fees?</h3>
                <p class="faq-answer">No, we believe in transparency. All fees will be clearly stated during the booking process.</p>
            </div>
            <div class="faq-item">
                <h3 class="faq-question">Can I get a refund for my booking?</h3>
                <p class="faq-answer">Refunds are available based on our cancellation policy. Please check our terms and conditions for more details.</p>
            </div>
        </div>
    </section>

    <?php include 'footer.php'?>















    <script src="javascript/home.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>

</html>