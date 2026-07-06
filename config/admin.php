<?php
// ─── CREDENTIALS ADMIN ─────────────────────────────────────────────────────
// IMPORTANT : Change the password before deploying to production!
// To generate a new hash: php -r "echo password_hash('YourPassword', PASSWORD_DEFAULT);"
// ────────────────────────────────────────────────────────────────────────────

define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2y$12$REMPLACER_PAR_VOTRE_HASH_BCRYPT_SECURISE');
// Default password: "Admin@Portfolio" — change it immediately!
