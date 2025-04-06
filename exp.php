<?php
require 'db.php';

try {
    $stmt = $pdo->query("SELECT users.name, experiences.user_comment, experiences.created_at
                         FROM experiences 
                         JOIN users ON experiences.users_id = users.users_id
                         ORDER BY experiences.created_at DESC");
    $experiences = $stmt->fetchAll();

    if ($experiences) {
        foreach ($experiences as $experience) {
            echo "<div class='user-experience'>";
            echo "<h4>" . htmlspecialchars($experience['name']) . "</h4>"; 
            echo "<p>" . htmlspecialchars($experience['user_comment']) . "</p>"; 
            echo "<small>Shared on: " . htmlspecialchars($experience['created_at']) . "</small>"; 
            echo "</div>";
        }
    } 
} catch (PDOException $e) {
    echo "⚠ Database Error: " . $e->getMessage();
}


