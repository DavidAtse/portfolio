<?php
require_once("../includes/csrf.php");
secure_session_start();
require_once("../config/admin.php");

// ── Rate limiting (IP + Session) ───────────────────────────────────────────
const MAX_ATTEMPTS = 5;
const LOCKOUT_SECS = 900; // 15 min

$rl        = rate_limit_status(MAX_ATTEMPTS, LOCKOUT_SECS);
$isLocked  = $rl['isLocked'];
$remaining = $rl['remaining'];
$error     = "";

// ── Handle POST ─────────────────────────────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($isLocked) {
        $error = "Trop de tentatives. Réessayez dans {$remaining} min.";
    } elseif (!csrf_verify()) {
        $error = "Requête invalide. Veuillez réessayer.";
        csrf_rotate();
    } else {
        $username   = trim($_POST['username'] ?? '');
        $password   = $_POST['password'] ?? '';
        $targetHash = ADMIN_PASS_HASH ?: '$2y$12$00000000000000000000000000000000000000000000000000000';

        $validUser = ADMIN_USER !== '' && hash_equals(ADMIN_USER, $username);
        $validPass = password_verify($password, $targetHash);

        if ($validUser && $validPass) {
            rate_limit_clear();
            session_regenerate_id(true);
            $_SESSION['admin']          = true;
            $_SESSION['_ua']            = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
            $_SESSION['_last_activity'] = time();
            csrf_rotate();
            header("Location: index.php");
            exit();
        } else {
            $rl        = rate_limit_record_failure(MAX_ATTEMPTS, LOCKOUT_SECS);
            $isLocked  = $rl['isLocked'];
            $remaining = $rl['remaining'];
            if ($isLocked) {
                $error = "Trop de tentatives. Compte bloqué 15 minutes.";
            } else {
                $left  = max(0, MAX_ATTEMPTS - $rl['attempts']);
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
