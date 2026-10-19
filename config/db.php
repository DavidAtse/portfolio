<?php
// ── Détection environnement ────────────────────────────────────────────────
$serverName = $_SERVER['SERVER_NAME'] ?? '';

$isLocal = in_array($serverName, ['localhost', '127.0.0.1', '::1'])
        || str_starts_with($serverName, '192.168.');

$isAlwaysData = str_contains($serverName, 'alwaysdata.net');

// 👉 OPTION MANUELLE pour un autre hébergeur spécifique si besoin
$useNovaHost = false; 

if ($isLocal) {
    // ── LOCAL (XAMPP) ──────────────────────────────────────────────────────
    $host   = "localhost";
    $dbname = "portfolio_db";
    $dbuser = "root";
    $dbpass = "";

} elseif ($isAlwaysData) {
    // ── PRODUCTION (Alwaysdata) ─────────────────────────────────────────────
    // À adapter avec tes identifiants créés sur Alwaysdata (section Bases de données) :
    $host   = "mysql-davedev.alwaysdata.net"; // Format: mysql-[nom-compte].alwaysdata.net
    $dbname = "davedev_portfolio";           // Format: [nom-compte]_portfolio
    $dbuser = "davedev";                     // Format: [nom-compte] (ou utilisateur créé)
    $dbpass = "VOTRE_MOT_DE_PASSE";   // Ton mot de passe défini sur Alwaysdata

} elseif ($useNovaHost) {
    // ── NOUVEL HÉBERGEUR (Nova / Voisilab) ────────────────────────────────
    $host   = "voisilab-data-mysql";
    $dbname = "db_portfolio_nova_063b8c";
    $dbuser = "u_portfolio_nova_063b8c";
    $dbpass = "VOTRE_MOT_DE_PASSE";

} else {
    // ── PRODUCTION (InfinityFree / Fallback) ────────────────────────────────
    $host   = "sql104.infinityfree.com";
    $dbname = "if0_41776090_portfolio_db";
    $dbuser = "if0_41776090";
    $dbpass = "VOTRE_MOT_DE_PASSE";
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