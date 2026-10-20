<?php
require_once __DIR__ . '/env.php';

// ── Détection environnement ────────────────────────────────────────────────
$serverName = $_SERVER['SERVER_NAME'] ?? '';

$isLocal = in_array($serverName, ['localhost', '127.0.0.1', '::1'], true)
        || str_starts_with($serverName, '192.168.');

// Désactiver l'affichage des erreurs PHP en production
if (!$isLocal) {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
}

if ($isLocal) {
    // ── LOCAL (XAMPP) ──────────────────────────────────────────────────────
    $host   = env('LOCAL_DB_HOST', 'localhost');
    $dbname = env('LOCAL_DB_NAME', 'portfolio_db');
    $dbuser = env('LOCAL_DB_USER', 'root');
    $dbpass = env('LOCAL_DB_PASS', '');
} else {
    // ── PRODUCTION (Chargé depuis le fichier .env non versionné) ───────────
    $host   = env('DB_HOST');
    $dbname = env('DB_NAME');
    $dbuser = env('DB_USER');
    $dbpass = env('DB_PASS');
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log("DB connection error: " . $e->getMessage());
    http_response_code(500);
    die("Erreur de connexion à la base de données.");
}
