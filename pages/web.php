<?php
require_once("../config/db.php");

$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'web' ORDER BY id DESC");
$stmt->execute();
$webProjects = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes projets Web - Atse David</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/web.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="web-container">
    <h1>Mes projets Web</h1>

    <?php if (empty($webProjects)): ?>
        <p class="empty-msg">Aucun projet web disponible pour le moment.</p>
    <?php else: ?>
    <div class="web-grid">
        <?php foreach ($webProjects as $i => $p): ?>
            <div class="web-card">
                <div class="bar-left"></div>

                <div class="web-image">
                    <img src="../uploads/<?= htmlspecialchars($p['image']) ?>"
                         alt="<?= htmlspecialchars($p['title']) ?>"
                         loading="lazy">
                </div>

                <div class="divider"></div>

                <div class="web-card-body">
                    <span class="card-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <h3><?= htmlspecialchars($p['title']) ?></h3>
                    <?php if (!empty($p['description'])): ?>
                        <p><?= htmlspecialchars($p['description']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($p['link'])): ?>
                        <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" rel="noopener noreferrer">
                            Voir le site
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
