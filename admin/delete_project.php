<?php
session_start();
require_once("../config/db.php");

// Protection : seul l'admin peut supprimer
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Vérifier que l'ID est bien passé
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_GET['id'];

// Récupérer le projet pour supprimer le fichier aussi
$stmt = $pdo->prepare("SELECT image FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if ($project) {
    // Supprimer le fichier physique (image ou vidéo)
    $filePath = "../uploads/" . $project['image'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Supprimer de la base de données
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit();