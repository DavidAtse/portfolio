<?php
session_start();
require_once("../config/db.php");
require_once("../includes/csrf.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// ── Allowed file types ────────────────────────────────────────────────────
const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'webm', 'mov', 'pdf'];
const ALLOWED_MIMES      = [
    'image/jpeg', 'image/png', 'image/gif', 'image/webp',
    'video/mp4', 'video/webm', 'video/quicktime',
    'application/pdf'
];
const MAX_FILE_SIZE      = 100 * 1024 * 1024; // 100 MB

$message = "";
$msgType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!csrf_verify()) {
        $message = "Requête invalide. Veuillez réessayer.";
        $msgType = "error";
    } else {
        csrf_rotate();

        $title       = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $category    = $_POST['category'] ?? '';
        $link        = trim($_POST['link'] ?? '');

        // Validate required fields
        if (empty($title) || empty($category)) {
            $message = "Le titre et la catégorie sont obligatoires.";
            $msgType = "error";
        } elseif (!in_array($category, ['web', 'photo', 'video', 'certificat'], true)) {
            $message = "Catégorie invalide.";
            $msgType = "error";
        } elseif (empty($_FILES['image']['name'])) {
            $message = "Veuillez choisir un fichier.";
            $msgType = "error";
        } else {
            $file     = $_FILES['image'];
            $origName = basename($file['name']);
            $tmpPath  = $file['tmp_name'];
            $fileSize = $file['size'];
            $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

            // Validate extension
            if (!in_array($ext, ALLOWED_EXTENSIONS, true)) {
                $message = "Extension de fichier non autorisée. Autorisé : " . implode(', ', ALLOWED_EXTENSIONS);
                $msgType = "error";
            }
            // Validate MIME type
            elseif (!in_array(mime_content_type($tmpPath), ALLOWED_MIMES, true)) {
                $message = "Type de fichier non autorisé.";
                $msgType = "error";
            }
            // Validate size
            elseif ($fileSize > MAX_FILE_SIZE) {
                $message = "Fichier trop lourd (max 100 MB).";
                $msgType = "error";
            } else {
                // Safe filename: timestamp + random + sanitized extension
                $newName  = time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
                $uploadDir = "../uploads/";

                if (move_uploaded_file($tmpPath, $uploadDir . $newName)) {
                    $stmt = $pdo->prepare(
                        "INSERT INTO projects (title, description, image, category, link) VALUES (?, ?, ?, ?, ?)"
                    );
                    $stmt->execute([$title, $description, $newName, $category, $link ?: null]);
                    $message = "Projet ajouté avec succès !";
                    $msgType = "success";
                } else {
                    $message = "Erreur lors de l'upload du fichier.";
                    $msgType = "error";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un projet</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <div class="admin-layout">

        <!-- SIDEBAR -->
        <aside class="admin-sidebar" id="sidebar">
            <div class="sidebar-logo">D<span>.</span>A</div>
            <span class="sidebar-label">Navigation</span>
            <ul class="sidebar-nav">
                <li><a href="index.php"><span class="nav-icon">▦</span> Dashboard</a></li>
                <li><a href="add_project.php" class="active"><span class="nav-icon">＋</span> Ajouter</a></li>
            </ul>
            <div class="sidebar-bottom">
                <a href="logout.php"><span>⏻</span> Déconnexion</a>
            </div>
        </aside>

        <!-- HAMBURGER -->
        <button class="hamburger" id="hamburger" aria-label="Menu" onclick="toggleSidebar()">
            <span></span><span></span><span></span>
        </button>

        <!-- MAIN -->
        <main class="admin-main">

            <div class="admin-topbar">
                <div>
                    <h1>Nouveau <span>Projet</span></h1>
                    <p class="topbar-sub">Ajoute un projet à ton portfolio</p>
                </div>
            </div>

            <div class="add-layout">

                <?php if ($message): ?>
                    <div class="msg-<?= htmlspecialchars($msgType) ?>"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <form class="add-form" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-field">
                        <label for="title">Titre du projet</label>
                        <input type="text" id="title" name="title" placeholder="Ex: Journal de Babi" required maxlength="255">
                    </div>

                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Décris ton projet en quelques lignes..." maxlength="2000"></textarea>
                    </div>

                    <div class="form-field">
                        <label for="category">Catégorie</label>
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Choisir une catégorie</option>
                            <option value="web">Site Web</option>
                            <option value="photo">Photoshop</option>
                            <option value="video">Vidéo</option>
                            <option value="certificat">Certificat</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="link">Lien du projet (optionnel)</label>
                        <input type="url" id="link" name="link" placeholder="https://...">
                    </div>

                    <div class="form-field">
                        <label>Image / Vidéo / PDF</label>
                        <div class="file-upload-wrap">
                            <input type="file" id="image" name="image" required
                                accept=".jpg,.jpeg,.png,.gif,.webp,.mp4,.webm,.mov,.pdf">
                            <label for="image" class="file-upload-label">
                                <div class="file-upload-icon">📁</div>
                                <div class="file-upload-text">
                                    <strong>Choisir un fichier</strong>
                                    <span>JPG, PNG, GIF, WEBP, MP4, WEBM, MOV, PDF — max 100 MB</span>
                                </div>
                            </label>
                            <p class="file-name-display" id="file-name"></p>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">Ajouter le projet</button>
                        <a href="index.php" class="btn-back">← Retour</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
    document.getElementById('image').addEventListener('change', function() {
        const name = this.files[0] ? this.files[0].name : '';
        document.getElementById('file-name').textContent = name ? '✓ ' + name : '';
    });
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('hamburger').classList.toggle('active');
    }
    </script>

</body>
</html>
