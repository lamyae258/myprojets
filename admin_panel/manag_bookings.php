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
        echo "✅ Tour added successfully!";
    } catch (PDOException $e) {
        echo "❌ Error adding tour: " . $e->getMessage();
    }
}

if (isset($_POST['updateTour'])) {
    $tourID = $_POST['tourID'];
    $newPrice = $_POST['tourPrice'];

    try {
        $stmt = $pdo->prepare("UPDATE tours SET price = :price WHERE id = :id");
        $stmt->execute(['price' => $newPrice, 'id' => $tourID]);
        echo "✅ Price updated successfully!";
    } catch (PDOException $e) {
        echo "❌ Error updating price: " . $e->getMessage();
    }
}

if (isset($_POST['deleteTour'])) {
    $tourID = $_POST['tourID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM tours WHERE id = :id");
        $stmt->execute(['id' => $tourID]);
        echo "✅ Tour deleted successfully!";
    } catch (PDOException $e) {
        echo "❌ Error deleting tour: " . $e->getMessage();
    }
}

$query = "SELECT * FROM tours";
$stmt =  $pdo->query($query);
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tours</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form method="POST" class="form-book">
        <h2 class="h2">Add New Tour</h2>
        <label class="label">Tour Name:</label>
        <input class="input" type="text" name="tourName" required></br>
        
        <label class="label">Tour Price:</label>
        <input class="input" type="number" name="tourPrice" required>
        
        <button class="btn-booking" type="submit" name="addTour">Add Tour</button>
    </form>

    <hr>

    <h2>Existing Tours</h2>
    <?php foreach ($tours as $tour): ?>
        <form method="POST" class="exiting">
            <input type="hidden" name="tourID" value="<?= $tour['id'] ?>">

            <label>Tour Name:</label>
            <input type="text" value="<?= htmlspecialchars($tour['name']) ?>" readonly>

            <label>Tour Price:</label>
            <input type="number" name="tourPrice" value="<?= htmlspecialchars($tour['price']) ?>">

            <button type="submit" name="updateTour">Update Price</button>
            <button type="submit" name="deleteTour" onclick="return confirm('Are you sure you want to delete this tour?')">Delete</button>
        </form>
        <hr>
    <?php endforeach; ?>
</body>
</html>
