<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'db.php'; 
require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    $mail = new PHPMailer(true);

    try {
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'lamlamyae2003@gmail.com';
        $mail->Password = 'atbt cdbn xexy lllk'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($email, $name);
        $mail->addAddress('lamlamyae2003@gmail.com', 'Agence de Tourisme');
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message de contact';
        $mail->Body = "
            <h3>Vous avez reçu un nouveau message de contact</h3>
            <p><strong>Nom :</strong> $name</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Téléphone :</strong> $phone</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $mail->send();
        $sql = "INSERT INTO contact_messages (name, email, phone, message) 
                VALUES (:name, :email, :phone, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':message' => $message
        ]);

        echo "Message envoyé et enregistré avec succès !";

    } catch (Exception $e) {
        echo "Erreur lors de l'envoi: " . $mail->ErrorInfo;
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement en base de données: " . $e->getMessage();
    }
}
?>
