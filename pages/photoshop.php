<?php
require_once("../config/db.php");

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Photoshop - Atse David</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/photoshop.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="gallery-container">
    <h1>Mes créations Photoshop</h1>

    <div class="filter-bar">
        <button onclick="filterPhotos('all')">Tous</button>
        <button onclick="filterPhotos('photo')">Photoshop</button>
    </div>

    <div class="gallery">

        <?php foreach ($projects as $project): ?>
            <?php if ($project['category'] === 'photo'): ?>

                <div class="photo-card" onclick="openLightbox('../uploads/<?= $project['image'] ?>')">

                    <img src="../uploads/<?= $project['image'] ?>" alt="">

                    <div class="overlay">
                        <h3><?= $project['title'] ?></h3>
                    </div>

                </div>

            <?php endif; ?>
        <?php endforeach; ?>

    </div>

    <!-- LIGHTBOX -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img">
    </div>
</div>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/photoshop.js"></script>

</body>
</html>