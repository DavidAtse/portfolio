<?php
session_start();

require_once("../config/admin.php");
require_once("../includes/csrf.php");

// ── Rate limiting ──────────────────────────────────────────────────────────
const MAX_ATTEMPTS   = 5;
const LOCKOUT_SECS   = 900; // 15 min

if (!isset($_SESSION['login_attempts']))  $_SESSION['login_attempts']  = 0;
if (!isset($_SESSION['lockout_until']))   $_SESSION['lockout_until']   = 0;

$isLocked     = time() < $_SESSION['lockout_until'];
$remaining    = max(0, ceil(($_SESSION['lockout_until'] - time()) / 60));
$error        = "";

// ── Handle POST ─────────────────────────────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($isLocked) {
        $error = "Trop de tentatives. Réessayez dans {$remaining} min.";
    } elseif (!csrf_verify()) {
        $error = "Requête invalide. Veuillez réessayer.";
        csrf_rotate();
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === ADMIN_USER && password_verify($password, ADMIN_PASS_HASH)) {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['lockout_until']  = 0;
            $_SESSION['admin']          = true;
            session_regenerate_id(true);
            csrf_rotate();
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= MAX_ATTEMPTS) {
                $_SESSION['lockout_until'] = time() + LOCKOUT_SECS;
                $error = "Trop de tentatives. Compte bloqué 15 minutes.";
            } else {
                $left  = MAX_ATTEMPTS - $_SESSION['login_attempts'];
                $error = "Identifiants incorrects. ({$left} essai" . ($left > 1 ? 's' : '') . " restant" . ($left > 1 ? 's' : '') . ")";
            }
        }
        csrf_rotate();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Connexion</title>
    <link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="login-page">

    <div class="login-wrap">

        <div class="login-brand">
            <span class="brand-logo">D<span>.</span>A</span>
            <span class="brand-sub">Espace Administration</span>
        </div>

        <div class="login-card">
            <h2>Connexion</h2>
            <span class="login-hint">— Accès restreint</span>

            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($isLocked): ?>
                <p class="error-msg">Compte bloqué. Réessayez dans <?= $remaining ?> min.</p>
            <?php else: ?>
            <form method="POST" autocomplete="off">
                <?= csrf_field() ?>
                <div class="field-group">
                    <label for="username">Identifiant</label>
                    <input type="text" id="username" name="username" placeholder="admin" required autocomplete="username">
                </div>
                <div class="field-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn-submit">Connexion →</button>
            </form>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>
