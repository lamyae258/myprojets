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
    <div class="heading" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/book.jpg) no-repeat;">

        <h1>Booking Us</h1>
    </div>


<div class="booking-container">
    <div id="booking-details"></div>
    <h1>Booking Process</h1>
    
      <form id="bookingForm" action="procuss_book.php" method="post">
        <div class="form-section">
            <h2>Booking Information</h2>
            <label for="clientName">Client Name:</label>
            <input type="text" id="clientName" name="clientName" required>

            <label for="clientEmail">Email Address:</label>
            <input type="email" id="clientEmail" name="clientEmail" required>

            <label for="clientPhone">Phone Number:</label>
            <input type="text" id="clientPhone" name="clientPhone" required>

            <label for="arrivalDate">Arrival Date:</label>
            <input type="date" id="arrivalDate" name="arrivalDate" required>

            <label for="departureDate">Departure Date:</label>
            <input type="date" id="departureDate" name="departureDate" required>

            <label for="numPersons">Number of People:</label>
            <input type="number" id="numPersons" name="numPersons" required>
        </div>

        <div class="form-section">
      <h2>Tour Details</h2>
      <?php
    require 'db.php';

    $sql = "SELECT * FROM tours";
    $stmt = $pdo->query($sql);
    $tours = $stmt->fetchAll();
    ?>
    <label for="tourName">Tour Name:</label>
    <select id="tourName" name="tourName" required>
    <?php foreach ($tours as $tour) : ?>
        <option value="<?= $tour['name']; ?>" data-price="<?= $tour['price']; ?>">
            <?= $tour['name']; ?> - DH<?= $tour['price']; ?>
        </option>
    <?php endforeach; ?>
    </select>
    
    <label for="tourDate">Tour Date:</label>
    <input type="date" id="tourDate" name="tourDate" required>

    <label for="tourPersons">Number of People:</label>
    <input type="number" id="tourPersons" name="tourPersons" required>

    <label for="tourPrice">Tour Price:</label>
    <input type="text" id="tourPrice" name="tourPrice" readonly required>

    <label for="tourDetails">Tour Details:</label>
    <textarea id="tourDetails" name="tourDetails" required></textarea>
   </div>
    <div class="form-section">
    <h2>Payment Details</h2>

    <label for="paymentMethod">Payment Method:</label>
    <select id="paymentMethod" name="paymentMethod" required>
        <option value="">-- Select Payment Method --</option>
        <option value="creditCard">Credit Card</option>
        <option value="bankTransfer">Bank Transfer</option>
    </select>
    <div id="creditCardDetails" style="display: none;">
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" name="cardNumber" placeholder="**** **** **** ****">

        <label for="cardExpiry">Expiry Date:</label>
        <input type="month" id="cardExpiry" name="cardExpiry">

        <label for="cardCVV">CVV:</label>
        <input type="text" id="cardCVV" name="cardCVV" placeholder="123">
    </div>

    <div id="bankTransferDetails" style="display: none;">
        <label for="bankAccount">Bank Account Number:</label>
        <input type="text" id="bankAccount" name="bankAccount" placeholder="1234567890">

        <label for="bankName">Bank Name:</label>
        <input type="text" id="bankName" name="bankName" placeholder="Bank Name">

        <label for="branchCode">Branch Code:</label>
        <input type="text" id="branchCode" name="branchCode" placeholder="Branch Code">

        <label for="accountHolderName">Account Holder Name:</label>
        <input type="text" id="accountHolderName" name="accountHolderName" placeholder="Account Holder Name">
    </div>
    </div>
    </form>
    <button type="submit" class="confirm-btn" form="bookingForm">Confirm Booking</button>
</div>

    
    <?php include 'footer.php'?>











<script src="javascript/booking.js"></script>
</body>
</html>