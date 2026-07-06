<?php
require_once("../config/db.php");

$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'video' ORDER BY id DESC");
$stmt->execute();
$videos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéo - Atse David</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/video.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="video-container">
    <h1>Mes montages vidéos</h1>

    <?php if (empty($videos)): ?>
        <p class="empty-msg">Aucune vidéo disponible pour le moment.</p>
    <?php else: ?>
    <div class="video-grid">
        <?php foreach ($videos as $v): ?>
            <div class="video-card">
                <video controls preload="metadata" loading="lazy">
                    <source src="../uploads/<?= htmlspecialchars($v['image']) ?>" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture vidéo.
                </video>
                <div class="video-info">
                    <h3><?= htmlspecialchars($v['title']) ?></h3>
                    <?php if (!empty($v['description'])): ?>
                        <p><?= htmlspecialchars($v['description']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($v['link'])): ?>
                        <a href="<?= htmlspecialchars($v['link']) ?>" target="_blank" rel="noopener noreferrer" class="video-link">
                            Voir plus →
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>

</body>
</html>
