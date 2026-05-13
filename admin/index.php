<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }
    include("../config/db.php");

    $projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
    $total   = count($projects);
    $web     = count(array_filter($projects, fn($p) => $p['category'] === 'web'));
    $photo   = count(array_filter($projects, fn($p) => $p['category'] === 'photo'));
    $video   = count(array_filter($projects, fn($p) => $p['category'] === 'video'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-layout">

        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="sidebar-logo">D<span>.</span>A</div>
            <span class="sidebar-label">Navigation</span>
            <ul class="sidebar-nav">
                <li><a href="index.php" class="active"><span class="nav-icon">▦</span> Dashboard</a></li>
                <li><a href="add_project.php"><span class="nav-icon">＋</span> Ajouter</a></li>
            </ul>
            <div class="sidebar-bottom">
                <a href="logout.php"><span>⏻</span> Déconnexion</a>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="admin-main">

            <!-- TOP BAR -->
            <div class="admin-topbar">
            <div>
                <h1>Dashboard <span>Admin</span></h1>
                <p class="topbar-sub">Gestion des projets du portfolio</p>
            </div>
            <div class="topbar-actions">
                <a href="add_project.php" class="btn-add">＋ Nouveau projet</a>
                <a href="logout.php" class="btn-logout">⏻ Logout</a>
            </div>
            </div>

            <!-- STATS -->
            <div class="stats-row">
                <div class="stat-card">
                    <p class="stat-label">Total projets</p>
                    <p class="stat-num"><?= $total ?><span class="accent">+</span></p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Sites Web</p>
                    <p class="stat-num"><?= $web ?><span class="accent">.</span></p>
                </div>
                <div class="stat-card red">
                    <p class="stat-label">Vidéos</p>
                    <p class="stat-num"><?= $video ?><span class="accent">.</span></p>
                </div>
                <div class="stat-card amber">
                    <p class="stat-label">Photoshop</p>
                    <p class="stat-num"><?= $photo ?><span class="accent">.</span></p>
                </div>
            </div>

            <!-- PROJETS -->
            <div class="section-head">
                <h2>Tous les projets</h2>
                <span><?= $total ?> entrées</span>
            </div>

            <div class="projects-grid">
                <?php foreach ($projects as $p): ?>
                    <div class="project-card">
                        <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" alt="">
                        <div class="project-card-body">
                            <h3><?= htmlspecialchars($p['title']) ?></h3>
                            <span class="cat-badge <?= htmlspecialchars($p['category']) ?>">
                            <?= htmlspecialchars($p['category']) ?>
                            </span>
                            <div class="btns">
                                <a href="delete_project.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce projet ?')">✕ Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </main>
    </div>

</body>
</html>