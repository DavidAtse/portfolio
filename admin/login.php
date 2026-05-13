<?php
    session_start();

    $adminUser = "admin";
    $adminPassHash = password_hash("1234", PASSWORD_DEFAULT);

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === $adminUser && password_verify($password, $adminPassHash)) {
            $_SESSION['admin'] = true;
            header("Location: index.php");
            exit();
        } else {
            $error = "Identifiants incorrects";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin — Connexion</title>
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

        <form method="POST">
        <div class="field-group">
            <label for="username">Identifiant</label>
            <input type="text" id="username" name="username" placeholder="admin" required>
        </div>
        <div class="field-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-submit">Connexion →</button>
        </form>
    </div>

    </div>

</body>
</html>
