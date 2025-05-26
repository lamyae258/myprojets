<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    die("Utilisateur non connecté !");
}
$author_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        if (!is_dir('uploadeAdmin')) {
            mkdir('uploadeAdmin', 0777, true);
        }

        $imagePath = 'uploadeAdmin/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "Erreur lors du téléchargement de l'image !";
            exit;
        }
    }

    if (!empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO blogs (title, content, image, author_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$title, $content, $imagePath, $author_id])) {
            echo "Article de blog ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout de l'article de blog.";
        }
    } else {
        echo "Entrée invalide !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un nouvel article de blog</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Ajouter un nouvel article de blog</h1>
        <form action="add_blogs.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="content">Contenu</label>
                <textarea name="content" id="content" rows="5" required></textarea>
            </div>
            <div>
                <label for="image">Téléverser une image</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit">Ajouter l’article</button>
            </div>
        </form>
    </div>
</body>
</html>
