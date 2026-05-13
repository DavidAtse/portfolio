<?php
require_once("../config/db.php");

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéo - Atse David</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/video.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="video-container">
    <h1>Mes montages vidéos</h1>

    <div class="video-grid">

        <?php foreach ($projects as $project): ?>
            <?php if ($project['category'] === 'video'): ?>

                <div class="video-card">

                    <video controls>
                        <source src="../uploads/<?= $project['image'] ?>" type="video/mp4">
                    </video>

                    <div class="video-info">
                        <h3><?= $project['title'] ?></h3>
                        <p><?= $project['description'] ?></p>
                    </div>

                </div>

            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>

</body>
</html>