<?php
require_once __DIR__ . '/env.php';

// ─── IDENTIFIANTS ADMIN (Chargés depuis .env non versionné) ─────────────────
define('ADMIN_USER', env('ADMIN_USER'));
define('ADMIN_PASS_HASH', env('ADMIN_PASS_HASH'));
