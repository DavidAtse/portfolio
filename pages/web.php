<?php
require_once("../config/db.php");

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes projets Web</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/web.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="web-container">
    <h1>Mes projets Web</h1>

    <div class="web-grid">

        <?php foreach ($projects as $project): ?>
            <?php if ($project['category'] === 'web'): ?>

                <div class="web-card">

                    <div class="web-image">
                        <img src="../uploads/<?= $project['image'] ?>" alt="">
                    </div>

                    <h3><?= $project['title'] ?></h3>
                    <p><?= $project['description'] ?></p>

                    <?php if ($project['link']): ?>
                        <a href="<?= $project['link'] ?>" target="_blank">Voir le site</a>
                    <?php endif; ?>

                </div>

            <?php endif; ?>
        <?php endforeach; ?>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>

</body>
</html>