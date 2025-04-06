<?php
require 'db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    die("User not logged in!");
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
            echo "Error uploading image!";
            exit;
        }
    }

    if (!empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO blogs (title, content, image, author_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$title, $content, $imagePath, $author_id])) {
            echo "Blog post added successfully!";
        } else {
            echo "Error adding blog post.";
        }
    } else {
        echo "Invalid input!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a New Blog Post</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Add a New Blog Post</h1>
        <form action="add_blogs.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" required></textarea>
            </div>
            <div>
                <label for="image">Upload Image</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit">Add Post</button>
            </div>
        </form>
    </div>
</body>
</html>
