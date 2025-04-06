<?php
require 'db.php'; // الاتصال بقاعدة البيانات

// تحقق من إرسال البيانات عبر POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تحقق من أن جميع المدخلات موجودة
    if (
        isset($_POST['clientName'], $_POST['clientEmail'], $_POST['clientPhone'], $_POST['arrivalDate'], 
              $_POST['departureDate'], $_POST['numPersons'], $_POST['tourName'], $_POST['tourDate'], 
              $_POST['tourPersons'], $_POST['tourPrice'], $_POST['tourDetails'], $_POST['paymentMethod'])
    ) {
        // تخزين القيم في متغيرات
        $clientName = $_POST['clientName'];
        $clientEmail = $_POST['clientEmail'];
        $clientPhone = $_POST['clientPhone'];
        $arrivalDate = $_POST['arrivalDate'];
        $departureDate = $_POST['departureDate'];
        $numPersons = $_POST['numPersons'];
        $tourName = $_POST['tourName'];
        $tourDate = $_POST['tourDate'];
        $tourPersons = $_POST['tourPersons'];
        $tourPrice = $_POST['tourPrice'];
        $tourDetails = $_POST['tourDetails'];
        $paymentMethod = $_POST['paymentMethod'];
        $sql = "INSERT INTO booking 
                (client_name, client_email, client_phone, arrival_date, departure_date, num_persons, 
                tour_name, tour_date, tour_persons, tour_price, tour_details, payment_method, 
                card_number, card_expiry, card_cvv, bank_account, bank_name, branch_code, account_holder_name) 
                VALUES 
                (:clientName, :clientEmail, :clientPhone, :arrivalDate, :departureDate, :numPersons, 
                :tourName, :tourDate, :tourPersons, :tourPrice, :tourDetails, :paymentMethod, 
                :cardNumber, :cardExpiry, :cardCVV, :bankAccount, :bankName, :branchCode, :accountHolderName)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':clientName', $clientName);
        $stmt->bindValue(':clientEmail', $clientEmail);
        $stmt->bindValue(':clientPhone', $clientPhone);
        $stmt->bindValue(':arrivalDate', $arrivalDate);
        $stmt->bindValue(':departureDate', $departureDate);
        $stmt->bindValue(':numPersons', $numPersons);
        $stmt->bindValue(':tourName', $tourName);
        $stmt->bindValue(':tourDate', $tourDate);
        $stmt->bindValue(':tourPersons', $tourPersons);
        $stmt->bindValue(':tourPrice', $tourPrice);
        $stmt->bindValue(':tourDetails', $tourDetails);
        $stmt->bindValue(':paymentMethod', $paymentMethod);

        if ($paymentMethod == 'creditCard') {
            $cardNumber = $_POST['cardNumber'];
            $cardExpiry = $_POST['cardExpiry'];
            $cardCVV = $_POST['cardCVV'];
            $stmt->bindValue(':cardNumber', $cardNumber);
            $stmt->bindValue(':cardExpiry', $cardExpiry);
            $stmt->bindValue(':cardCVV', $cardCVV);
            $stmt->bindValue(':bankAccount', null);
            $stmt->bindValue(':bankName', null);
            $stmt->bindValue(':branchCode', null);
            $stmt->bindValue(':accountHolderName', null);
        } else {
            $bankAccount = $_POST['bankAccount'];
            $bankName = $_POST['bankName'];
            $branchCode = $_POST['branchCode'];
            $accountHolderName = $_POST['accountHolderName'];
            $stmt->bindValue(':cardNumber', null);
            $stmt->bindValue(':cardExpiry', null);
            $stmt->bindValue(':cardCVV', null);
            $stmt->bindValue(':bankAccount', $bankAccount);
            $stmt->bindValue(':bankName', $bankName);
            $stmt->bindValue(':branchCode', $branchCode);
            $stmt->bindValue(':accountHolderName', $accountHolderName);
        }

    
        if ($stmt->execute()) {
            
            echo "<div class='booking-details'>
                    <h2>Your Booking Details</h2>
                    <ul>
                        <li><strong>Client Name:</strong> $clientName</li>
                        <li><strong>Email:</strong> $clientEmail</li>
                        <li><strong>Phone:</strong> $clientPhone</li>
                        <li><strong>Arrival Date:</strong> $arrivalDate</li>
                        <li><strong>Departure Date:</strong> $departureDate</li>
                        <li><strong>Tour Name:</strong> $tourName</li>
                        <li><strong>Tour Date:</strong> $tourDate</li>
                        <li><strong>Tour Price:</strong> $tourPrice</li>
                        <li><strong>Payment Method:</strong> $paymentMethod</li>
                    </ul>
                  </div>";
        } else {
            echo "Error confirming the booking.";
        }
    } else {
        echo "Please fill in all the required fields.";
    }
}
?>
