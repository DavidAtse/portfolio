<?php
require_once("../config/db.php");

$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'photo' ORDER BY id DESC");
$stmt->execute();
$photos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photoshop - Atse David</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/photoshop.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="gallery-container">
    <h1>Mes créations Photoshop</h1>

    <?php if (empty($photos)): ?>
        <p class="empty-msg">Aucune création disponible pour le moment.</p>
    <?php else: ?>
    <div class="gallery">
        <?php foreach ($photos as $p): ?>
            <div class="photo-card"
                 onclick="openLightbox('../uploads/<?= htmlspecialchars($p['image'], ENT_QUOTES) ?>')"
                 role="button" tabindex="0"
                 aria-label="<?= htmlspecialchars($p['title']) ?>">

                <img src="../uploads/<?= htmlspecialchars($p['image']) ?>"
                     alt="<?= htmlspecialchars($p['title']) ?>"
                     loading="lazy">

                <div class="overlay">
                    <h3><?= htmlspecialchars($p['title']) ?></h3>
                    <?php if (!empty($p['description'])): ?>
                        <p><?= htmlspecialchars($p['description']) ?></p>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <!-- LIGHTBOX -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()" role="dialog" aria-modal="true">
        <button class="lightbox-close" onclick="closeLightbox()" aria-label="Fermer">✕</button>
        <img id="lightbox-img" alt="">
    </div>
    <?php endif; ?>
</div>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/photoshop.js"></script>

</body>
</html>
