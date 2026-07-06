<?php
// Calculate depth of calling script relative to portfolio root
$portfolioRoot = str_replace('\\', '/', dirname(dirname(__FILE__)));
$scriptDir     = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']));
$relPath       = trim(str_replace($portfolioRoot, '', $scriptDir), '/');
$depth         = ($relPath === '') ? 0 : (substr_count($relPath, '/') + 1);
$base          = str_repeat('../', $depth);
$homeUrl       = $base . 'index.php';

$currentPage   = basename($_SERVER['SCRIPT_FILENAME']);
$currentDir    = basename(dirname($_SERVER['SCRIPT_FILENAME']));
$isPages       = ($currentDir === 'pages');
?>
<nav>
    <a href="<?= htmlspecialchars($homeUrl) ?>" class="nav-logo">D<span>.</span>A</a>

    <ul class="nav-links">
        <li><a href="<?= htmlspecialchars($homeUrl) ?>#services" <?= (!$isPages && $currentPage === 'index.php') ? 'class="active"' : '' ?>>Services</a></li>
        <li><a href="<?= htmlspecialchars($homeUrl) ?>#services">Projets</a></li>
        <li><a href="<?= htmlspecialchars($homeUrl) ?>#about" <?= (!$isPages && $currentPage === 'index.php') ? 'class="active"' : '' ?>>À propos</a></li>
        <li><a href="<?= htmlspecialchars($homeUrl) ?>#cv-section">Contact</a></li>
    </ul>

    <button class="nav-hamburger" id="nav-hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>
