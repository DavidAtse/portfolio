<?php
/**
 * Initialisation sécurisée de la session (HttpOnly, SameSite=Strict, Anti-Fixation, Timeout)
 */
function secure_session_start(): void {
    if (session_status() === PHP_SESSION_NONE) {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
                || (($_SERVER['SERVER_PORT'] ?? null) == 443);

        ini_set('session.use_only_cookies', '1');
        ini_set('session.use_strict_mode', '1');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'domain'   => '',
            'secure'   => $isHttps,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);

        session_start();
    }

    // Protection contre le détournement de session (User-Agent binding)
    $currentUa = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');
    if (isset($_SESSION['admin'])) {
        if (isset($_SESSION['_ua']) && !hash_equals($_SESSION['_ua'], $currentUa)) {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        }
        // Expiration après 30 minutes d'inactivité
        if (isset($_SESSION['_last_activity']) && (time() - $_SESSION['_last_activity'] > 1800)) {
            session_unset();
            session_destroy();
            header("Location: login.php?timeout=1");
            exit();
        }
        $_SESSION['_last_activity'] = time();
    }
}

/**
 * Protection CSRF
 */
function csrf_generate(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify(): bool {
    $token = $_POST['csrf_token'] ?? '';
    return !empty($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_generate(), ENT_QUOTES, 'UTF-8') . '">';
}

function csrf_rotate(): void {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * Rate Limiting par IP (stocké côté serveur pour empêcher le contournement par suppression de cookies)
 */
function get_client_ip_hash(): string {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return hash('sha256', 'portfolio_rl_' . $ip);
}

function get_rate_limit_file(): string {
    return rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'pf_login_rl.json';
}

function get_rate_limit_data(): array {
    $file = get_rate_limit_file();
    if (!is_file($file)) {
        return [];
    }
    $content = @file_get_contents($file);
    $data    = $content ? json_decode($content, true) : [];
    return is_array($data) ? $data : [];
}

function save_rate_limit_data(array $data): void {
    $file = get_rate_limit_file();
    // Nettoyer les entrées expirées de plus d'une heure
    $now = time();
    foreach ($data as $k => $v) {
        if (($v['lockout_until'] ?? 0) < $now && ($now - ($v['last_attempt'] ?? 0)) > 3600) {
            unset($data[$k]);
        }
    }
    @file_put_contents($file, json_encode($data), LOCK_EX);
}

function rate_limit_status(int $maxAttempts = 5, int $lockoutSecs = 900): array {
    $ipHash = get_client_ip_hash();
    $data   = get_rate_limit_data();
    $entry  = $data[$ipHash] ?? ['attempts' => 0, 'lockout_until' => 0];

    $sessAttempts = $_SESSION['login_attempts'] ?? 0;
    $sessLockout  = $_SESSION['lockout_until'] ?? 0;

    $attempts     = max($entry['attempts'], $sessAttempts);
    $lockoutUntil = max($entry['lockout_until'], $sessLockout);
    $isLocked     = time() < $lockoutUntil;
    $remainingMin = max(0, (int)ceil(($lockoutUntil - time()) / 60));

    return [
        'isLocked'  => $isLocked,
        'attempts'  => $attempts,
        'remaining' => $remainingMin,
    ];
}

function rate_limit_record_failure(int $maxAttempts = 5, int $lockoutSecs = 900): array {
    $ipHash = get_client_ip_hash();
    $data   = get_rate_limit_data();
    $entry  = $data[$ipHash] ?? ['attempts' => 0, 'lockout_until' => 0, 'last_attempt' => 0];

    if ($entry['lockout_until'] > 0 && time() >= $entry['lockout_until']) {
        $entry['attempts']      = 0;
        $entry['lockout_until'] = 0;
    }

    $entry['attempts']++;
    $entry['last_attempt'] = time();

    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;

    if ($entry['attempts'] >= $maxAttempts || $_SESSION['login_attempts'] >= $maxAttempts) {
        $lockUntil              = time() + $lockoutSecs;
        $entry['lockout_until'] = $lockUntil;
        $_SESSION['lockout_until'] = $lockUntil;
    }

    $data[$ipHash] = $entry;
    save_rate_limit_data($data);

    return rate_limit_status($maxAttempts, $lockoutSecs);
}

function rate_limit_clear(): void {
    $ipHash = get_client_ip_hash();
    $data   = get_rate_limit_data();
    if (isset($data[$ipHash])) {
        unset($data[$ipHash]);
        save_rate_limit_data($data);
    }
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_until']  = 0;
}
