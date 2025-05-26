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
    <div class="heading" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/book.jpg) no-repeat;">
        <h1>Réservez chez nous</h1>
    </div>

<div class="booking-container">
    <div id="booking-details"></div>
    <h1>Processus de Réservation</h1>
    
    <form id="bookingForm" action="procuss_book.php" method="post">
        <div class="form-section">
            <h2>Informations de Réservation</h2>
            <label for="clientName">Nom du client :</label>
            <input type="text" id="clientName" name="clientName" required>

            <label for="clientEmail">Adresse e-mail :</label>
            <input type="email" id="clientEmail" name="clientEmail" required>

            <label for="clientPhone">Numéro de téléphone :</label>
            <input type="text" id="clientPhone" name="clientPhone" required>

            <label for="arrivalDate">Date d'arrivée :</label>
            <input type="date" id="arrivalDate" name="arrivalDate" required>

            <label for="departureDate">Date de départ :</label>
            <input type="date" id="departureDate" name="departureDate" required>

            <label for="numPersons">Nombre de personnes :</label>
            <input type="number" id="numPersons" name="numPersons" required>
        </div>

        <div class="form-section">
            <h2>Détails de la visite</h2>
            <?php
            require 'db.php';

            $sql = "SELECT * FROM tours";
            $stmt = $pdo->query($sql);
            $tours = $stmt->fetchAll();
            ?>
            <label for="tourName">Nom de la visite :</label>
            <select id="tourName" name="tourName" required>
            <?php foreach ($tours as $tour) : ?>
                <option value="<?= $tour['name']; ?>" data-price="<?= $tour['price']; ?>">
                    <?= $tour['name']; ?> - DH<?= $tour['price']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            
            <label for="tourDate">Date de la visite :</label>
            <input type="date" id="tourDate" name="tourDate" required>

            <label for="tourPersons">Nombre de personnes :</label>
            <input type="number" id="tourPersons" name="tourPersons" required>

            <label for="tourPrice">Prix de la visite :</label>
            <input type="text" id="tourPrice" name="tourPrice" readonly required>

            <label for="tourDetails">Détails de la visite :</label>
            <textarea id="tourDetails" name="tourDetails" required></textarea>
        </div>

        <div class="form-section">
            <h2>Détails du paiement</h2>

            <label for="paymentMethod">Méthode de paiement :</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="">-- Sélectionner la méthode de paiement --</option>
                <option value="creditCard">Carte de crédit</option>
                <option value="bankTransfer">Virement bancaire</option>
            </select>

            <div id="creditCardDetails" style="display: none;">
                <label for="cardNumber">Numéro de carte :</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="**** **** **** ****">

                <label for="cardExpiry">Date d'expiration :</label>
                <input type="month" id="cardExpiry" name="cardExpiry">

                <label for="cardCVV">CVV :</label>
                <input type="text" id="cardCVV" name="cardCVV" placeholder="123">
            </div>

            <div id="bankTransferDetails" style="display: none;">
                <label for="bankAccount">Numéro de compte bancaire :</label>
                <input type="text" id="bankAccount" name="bankAccount" placeholder="1234567890">

                <label for="bankName">Nom de la banque :</label>
                <input type="text" id="bankName" name="bankName" placeholder="Nom de la banque">

                <label for="branchCode">Code de l'agence :</label>
                <input type="text" id="branchCode" name="branchCode" placeholder="Code de l'agence">

                <label for="accountHolderName">Nom du titulaire du compte :</label>
                <input type="text" id="accountHolderName" name="accountHolderName" placeholder="Nom du titulaire du compte">
            </div>
        </div>
    </form>
    <button type="submit" class="confirm-btn" form="bookingForm">Confirmer la réservation</button>
</div>

<?php include 'footer.php'?>

<script src="javascript/booking.js"></script>
</body>
</html>
