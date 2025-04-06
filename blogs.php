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
    <div class="heading" style="background:linear-gradient(rgba(17,17,17,.7),rgba(17,17,17,.7)), url(image/blogs.jpg) no-repeat;">
        <h1>out blogs</h1>
    </div>

    <section class="blogs" >
<?php
include('db.php');
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll();
?>

    <h1>Tourism Articles in Morocco</h1>
    <div class="blogs-container" >
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-item" id="fade-in">
                    <?php if (!empty($blog['image'])): ?>
                        <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="blog-image">
                    <?php else: ?>
                        <img src="uploadeAdmin/default.jpg" alt="Default Image" class="blog-image">
                    <?php endif; ?>
                    <h2><?= htmlspecialchars($blog['title']) ?></h2>
                   
                    <p class="blog-summary"><?= substr(htmlspecialchars($blog['content']), 0, 150) ?>...</p>
             
                    <p class="blog-full-content" style="display:none;"><?= htmlspecialchars($blog['content']) ?></p>
                  
                    <button class="read-more-btn">Read More</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blogs found!</p>
        <?php endif; ?>
    </div>
</section>




<section class="experience">
    <div class="image_path" id="fade-in">
    <div class="upload-container">
    </div>
</div>
<h4>Share Your Experience</h4>
    <div class="user-share-experience" id="fade-in">
        
        <form id="experience-form" method="POST" action="submit_experience.php">
            <label for="user-comment">Your Experience:</label><br>
            <textarea id="user-comment" name="user_comment" rows="4" placeholder="Share your experience here..." required></textarea><br><br>

            <button type="submit">Submit Your Experience</button>
        </form>
    </div>
    
    <article class="blogs" id="fade-in">
        <div class="blog-contents" id="experience-list">
            <?php include 'exp.php'; ?>
        </div>
    </article>
</section>
    
     



     



<?php include 'footer.php'?>


<script src="javascript/blogs.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>