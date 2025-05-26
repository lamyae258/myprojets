<?php
require 'db.php'; 

if (isset($_POST['addTour'])) {
    $tourName = $_POST['tourName'];
    $tourPrice = $_POST['tourPrice'];

    try {
        $stmt = $pdo->prepare("INSERT INTO tours (name, price) VALUES (:name, :price)");
        $stmt->bindParam(':name', $tourName);
        $stmt->bindParam(':price', $tourPrice);
        $stmt->execute();
        echo "✅ Excursion ajoutée avec succès!";
    } catch (PDOException $e) {
        echo "❌ Erreur lors de l'ajout de l'excursion: " . $e->getMessage();
    }
}

if (isset($_POST['updateTour'])) {
    $tourID = $_POST['tourID'];
    $newPrice = $_POST['tourPrice'];

    try {
        $stmt = $pdo->prepare("UPDATE tours SET price = :price WHERE id = :id");
        $stmt->execute(['price' => $newPrice, 'id' => $tourID]);
        echo "✅ Prix mis à jour avec succès!";
    } catch (PDOException $e) {
        echo "❌ Erreur lors de la mise à jour du prix: " . $e->getMessage();
    }
}

if (isset($_POST['deleteTour'])) {
    $tourID = $_POST['tourID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM tours WHERE id = :id");
        $stmt->execute(['id' => $tourID]);
        echo "✅ Excursion supprimée avec succès!";
    } catch (PDOException $e) {
        echo "❌ Erreur lors de la suppression de l'excursion: " . $e->getMessage();
    }
}

$query = "SELECT * FROM tours";
$stmt =  $pdo->query($query);
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Excursions</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form method="POST" class="form-book">
        <h2 class="h2">Ajouter une nouvelle excursion</h2>
        <label class="label">Nom de l'excursion :</label>
        <input class="input" type="text" name="tourName" required></br>
        
        <label class="label">Prix de l'excursion :</label>
        <input class="input" type="number" name="tourPrice" required>
        
        <button class="btn-booking" type="submit" name="addTour">Ajouter l'excursion</button>
    </form>

    <hr>

    <h2>Excursions existantes</h2>
    <?php foreach ($tours as $tour): ?>
        <form method="POST" class="exiting">
            <input type="hidden" name="tourID" value="<?= $tour['id'] ?>">

            <label>Nom de l'excursion :</label>
            <input type="text" value="<?= htmlspecialchars($tour['name']) ?>" readonly>

            <label>Prix de l'excursion :</label>
            <input type="number" name="tourPrice" value="<?= htmlspecialchars($tour['price']) ?>">

            <button type="submit" name="updateTour">Mettre à jour le prix</button>
            <button type="submit" name="deleteTour" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette excursion ?')">Supprimer</button>
        </form>
        <hr>
    <?php endforeach; ?>
</body>
</html>
