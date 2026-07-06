<?php
require_once("../config/db.php");

$stmt = $pdo->prepare("SELECT * FROM projects WHERE category = 'certificat' ORDER BY id DESC");
$stmt->execute();
$certificats = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificats - Atse David</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/certificat.css">
</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<section class="certificates-container">

    <h1 class="certificates-title">
        Mes <span>Certificats</span>
    </h1>

    <?php if (empty($certificats)): ?>
        <p class="empty-message">Aucun certificat disponible pour le moment.</p>
    <?php else: ?>
    <div class="certificates-grid">
        <?php foreach ($certificats as $c): ?>
            <div class="certificate-card">

                <div class="pdf-icon">📄</div>

                <h3><?= htmlspecialchars($c['title']) ?></h3>

                <?php if (!empty($c['description'])): ?>
                    <p><?= htmlspecialchars($c['description']) ?></p>
                <?php endif; ?>

                <a href="../uploads/<?= htmlspecialchars($c['image']) ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="certificate-btn">
                    Voir le certificat
                </a>

            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</section>

<?php include("../includes/footer.php"); ?>
<script src="../assets/js/script.js"></script>

</body>
</html>
