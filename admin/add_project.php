<?php
    session_start();
    require_once("../config/db.php");
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }

    $message = "";
    $msgType = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title       = $_POST['title'];
        $description = $_POST['description'];
        $category    = $_POST['category'];
        $link        = $_POST['link'];

        $imageName = $_FILES['image']['name'];
        $tmpName   = $_FILES['image']['tmp_name'];
        $uploadDir = "../uploads/";
        $newName   = time() . "_" . $imageName;

        if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
            $stmt = $pdo->prepare("INSERT INTO projects (title, description, image, category, link) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $newName, $category, $link]);
            $message = "Projet ajouté avec succès !";
            $msgType = "success";
        } else {
            $message = "Erreur lors de l'upload de l'image.";
            $msgType = "error";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un projet</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <div class="admin-layout">

        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="sidebar-logo">GG<span>.</span></div>
            <span class="sidebar-label">Navigation</span>
            <ul class="sidebar-nav">
                <li><a href="index.php"><span class="nav-icon">▦</span> Dashboard</a></li>
                <li><a href="add_project.php" class="active"><span class="nav-icon">＋</span> Ajouter</a></li>
            </ul>
            <div class="sidebar-bottom">
                <a href="logout.php"><span>⏻</span> Déconnexion</a>
            </div>
        </aside>

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
                    <div class="msg-<?= $msgType ?>"><?= $message ?></div>
                <?php endif; ?>

                <form class="add-form" method="POST" enctype="multipart/form-data">

                    <div class="form-field">
                        <label for="title">Titre du projet</label>
                        <input type="text" id="title" name="title" placeholder="Ex: Journal de Babi" required>
                    </div>

                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Décris ton projet en quelques lignes..."></textarea>
                    </div>

                    <div class="form-field">
                        <label for="category">Catégorie</label>
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Choisir une catégorie</option>
                            <option value="web">Site Web</option>
                            <option value="photo">Photoshop</option>
                            <option value="video">Vidéo</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="link">Lien du projet (optionnel)</label>
                        <input type="text" id="link" name="link" placeholder="https://...">
                    </div>

                    <div class="form-field">
                        <label>Image / Fichier</label>
                        <div class="file-upload-wrap">
                            <input type="file" id="image" name="image" required>
                            <label for="image" class="file-upload-label">
                            <div class="file-upload-icon">📁</div>
                            <div class="file-upload-text">
                                <strong>Choisir un fichier</strong>
                                <span>JPG, PNG, MP4 — max 10MB</span>
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
    </script>

</body>
</html>
