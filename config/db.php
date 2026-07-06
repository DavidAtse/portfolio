<?php
// ── Détection environnement ────────────────────────────────────────────────
$isLocal = in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1', '::1'])
        || str_starts_with($_SERVER['SERVER_NAME'] ?? '', '192.168.');

if ($isLocal) {
    // ── LOCAL (XAMPP) ──────────────────────────────────────────────────────
    $host   = "localhost";
    $dbname = "portfolio_db";
    $dbuser = "root";
    $dbpass = "";
} else {
    // ── PRODUCTION (InfinityFree) ──────────────────────────────────────────
    $host   = "sql104.infinityfree.com";
    $dbname = "if0_41776090_portfolio_db";
    $dbuser = "if0_41776090";
    $dbpass = "GcqTmzhyAWB";
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    error_log("DB connection error: " . $e->getMessage());
    die("Erreur de connexion à la base de données.");
}
