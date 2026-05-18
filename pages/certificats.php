<?php
require_once("../config/db.php");

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificats - Atse David</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/photoshop.css">
    <link rel="stylesheet" href="../assets/css/certificat.css">


</head>
<body>

<?php include("../includes/loader.php"); ?>
<?php include("../includes/navbar.php"); ?>

<section class="certificates-container">

    <h1 class="certificates-title">
        Mes <span>Certificats</span>
    </h1>

    <div class="certificates-grid">

        <?php
        $hasCertificates = false;

        foreach ($projects as $project):
            if ($project['category'] === 'certificat'):

                $hasCertificates = true;
        ?>

            <div class="certificate-card">

                <div class="pdf-icon">📄</div>

                <h3>
                    <?= htmlspecialchars($project['title']) ?>
                </h3>

                <p>
                    <?= htmlspecialchars($project['description']) ?>
                </p>

                <a
                    href="../uploads/<?= htmlspecialchars($project['image']) ?>"
                    target="_blank"
                    class="certificate-btn"
                >
                    Voir le certificat
                </a>

            </div>

        <?php
            endif;
        endforeach;
        ?>

    </div>

    <?php if (!$hasCertificates): ?>

        <p class="empty-message">
            Aucun certificat disponible pour le moment.
        </p>

    <?php endif; ?>

</section>

<?php include("../includes/footer.php"); ?>

<script src="../assets/js/script.js"></script>

</body>
</html>