<?php
include 'db.php'; 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM services WHERE service_id = :service_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':service_id', $id);
    $stmt->execute();
    header('Location: admin_services.php');
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['service_id'];
    $title = $_POST['title'];
    $icon = $_POST['icon'];
    $description = $_POST['description'];

    $query = "UPDATE services SET title = :title, icon = :icon, description = :description WHERE service_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':icon', $icon);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    header('Location: admin_services.php');
    exit();
}
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $icon = $_POST['icon'];
    $description = $_POST['description'];

    $query = "INSERT INTO services (title, icon, description) VALUES (:title, :icon, :description)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':icon', $icon);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    header('Location: admin_services.php');
    exit();
}
$query = "SELECT * FROM services";
$stmt = $pdo->prepare($query);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Manage Services</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>


<form method="POST" action="" class="form-box" >
    <h2>Add New Service</h2>
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="icon" placeholder="FontAwesome Icon (e.g., fas fa-map-marked-alt)" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit" name="submit" class="btn-add">Add Service</button>
</form>
<table class="table-service">
    <thead>
        <tr>
            <th>Title</th>
            <th>Icon</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service) { ?>
            <tr>
                <form method="POST" action="">
                    <td>
                        <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
                        <input type="text" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>
                    </td>
                    <td>
                        <input type="text" name="icon" value="<?php echo htmlspecialchars($service['icon']); ?>" required>
                    </td>
                    <td>
                        <textarea name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea>
                    </td>
                    <td>
                        <button type="submit" name="update" class="btn-edit">Update</button>
                        <a href="admin_services.php?delete=<?php echo $service['service_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
