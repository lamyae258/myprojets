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
    <div class="heading" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/contact.jpg) no-repeat;">
        <h1>out blogs</h1>
    </div>

<section class="contact">
<div class="container" >
    <h2>Contact Us</h2>

    <div class="contact-container">
        <div class="form-container">
        <h3>Get in Touch</h3>
        <form action="submit_contact.php" method="POST">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p> <b>Phone:</b> +212 123 456 789</p>
            <p> <b>Email:</b> contact@tourismagency.ma</p>
            <p> <b>Address:</b> Mohammed V Avenue, Casablanca, Morocco</p>
            <img src="image/malgarlogo.png" alt="">
           
        </div>
    </div>
</div>
</section>

<?php include 'footer.php'?>




    <script src="javascript/contact.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>