<?php
session_start();
require_once("../config/db.php");
require_once("../includes/csrf.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

if (!csrf_verify()) {
    header("Location: index.php?error=csrf");
    exit();
}
csrf_rotate();

if (!isset($_POST['id']) || !ctype_digit((string)$_POST['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_POST['id'];

$stmt = $pdo->prepare("SELECT image FROM projects WHERE id = ?");
$stmt->execute([$id]);
$project = $stmt->fetch();

if ($project) {
    $filePath = "../uploads/" . basename($project['image']);
    if (file_exists($filePath) && is_file($filePath)) {
        unlink($filePath);
    }

    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit();
