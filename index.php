<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Portfolio — David Atse</title>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <!-- CURSOR -->
        <div id="cursor"></div>
        <div id="cursor-ring"></div>

        <?php include("includes/loader.php") ?>
        <?php include("includes/navbar.php") ?>

        <!-- HERO -->
        <section id="home">
            <div class="hero-lines"></div>
            <div class="hero-bg-circle"></div>

            <div class="hero-left">
                <p class="hero-tag">Developpeur & monteur</p>
                <h1 class="hero-title">Je suis<br><span class="accent">David Atse</span></h1>
                <p class="hero-subtitle">Développeur web passionné, je conçois des sites web et des applications modernes, performantes et centrées sur l’utilisateur.</p>
                <div class="hero-ctas">
                    <a href="#projets-web" class="btn-primary">Voir mes projets</a>
                    <a href="#cv-section" class="btn-outline">Télécharger le CV</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="photo-frame">
                    <div class="photo-deco-ring"></div>
                    <div class="photo-inner">
                        <img src="assets/image/télécharger.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat">
                <span class="stat-num">2<span>+</span></span>
                <span class="stat-label">Années d'expérience</span>
            </div>
            <div class="stat">
                <span class="stat-num">13<span>+</span></span>
                <span class="stat-label">Projets réalisés</span>
            </div>
            <div class="stat">
                <span class="stat-num">12<span>+</span></span>
                <span class="stat-label">Clients satisfaits</span>
            </div>
            <div class="stat">
                <span class="stat-num">4</span>
                <span class="stat-label">Disciplines créatives</span>
            </div>
        </div>

        <!-- SERVICES -->
        <section id="services">
            <p class="section-label">Ce que je fais</p>
            <h2 class="section-title">Mes <span>Services</span> <span class="stat-label">(Vous pouvez cliquer pour en savoir plus)</span></h2>
            <div class="services-grid">
        
                <a href="pages/web.php" class="service-card">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <h3 class="service-name">Web Design</h3>
                    <p class="service-desc">
                        Création de sites web modernes, responsives et performants. De la landing page au portfolio complet, chaque pixel est pensé pour l'impact.
                    </p>
                </a>
        
                <a href="pages/photoshop.php" class="service-card" id="projets-photo">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                    </div>
                    <h3 class="service-name">Photoshop & Retouche</h3>
                    <p class="service-desc">
                        Retouche photo professionnelle, création de visuels percutants et amélioration d’images pour un rendu esthétique, moderne et de haute qualité.
                    </p>
                </a>
        
                <a href="pages/video.php" class="service-card" id="projets-video">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                    </div>
                    <h3 class="service-name">Montages Vidéo</h3>
                    <p class="service-desc">
                        Montage créatif, motion design et storytelling vidéo. Des contenus qui captivent et engagent ton audience dès la première seconde.
                    </p>
                </a>
        
            </div>
        </section>

        <!-- ABOUT -->
        <section id="about">
            <div class="about-visual">
                <div class="about-photo">
                <img src="assets/image/télécharger (1).png" alt="">
                </div>
            </div>

            <div class="about-text">
                <p class="section-label">Qui suis-je ?</p>
                <h2 class="section-title" style="margin-bottom: 1.5rem;">Développeur & Créatif<br><span>Digital</span></h2>
                <p>
                    Je suis David Atse, développeur web et créatif digital passionné par la conception d’expériences modernes et impactantes. 
                    Actuellement en pleine évolution dans le domaine du développement, je construis progressivement mon expertise à travers 
                    des projets concrets mêlant code, design et storytelling visuel.
                </p>
                <p>
                    Mon parcours est basé sur la pratique : création de sites web dynamiques, réalisation de visuels professionnels avec Photoshop 
                    et montage de contenus vidéo engageants. J’ai notamment travaillé sur des projets réels comme la conception d’une plateforme 
                    web complète et le développement de concepts digitaux ambitieux.
                </p>
                <p>
                    Aujourd’hui, je suis capable de concevoir des interfaces modernes, développer des applications web fonctionnelles 
                    et produire des contenus visuels de qualité. Mon objectif est clair : évoluer vers la création de plateformes innovantes 
                    à grande échelle, en alliant performance, design et expérience utilisateur.
                </p>
                <div class="skills-list">
                    <span class="skill-pill">HTML / CSS</span>
                    <span class="skill-pill">JavaScript</span>
                    <span class="skill-pill">PHP</span>
                    <span class="skill-pill">CapCut</span>
                    <span class="skill-pill">Adobe Photoshop</span>
                    <span class="skill-pill">UI / UX</span>
                </div>
            </div>
        </section>

        <!-- CV DOWNLOAD -->
        <section id="cv-section">
            <div class="cv-inner">
                <p class="section-label" style="justify-content: center;">Travaillons ensemble</p>
                <h2 class="section-title">Mon <span>CV</span> & Contact</h2>
                <p>Tu veux en savoir plus sur mon parcours ou collaborer sur un projet ? Télécharge mon CV ou envoie-moi un message directement.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="assets/files/CV David Atse.pdf" download class="btn-primary">↓ Télécharger CV</a>
                    <a href="mailto:daatsey24@gmail.com" class="btn-outline">Me contacter</a>
                </div>
            </div>
        </section>

        <?php include("includes/footer.php") ?>
        <script src="assets/js/script.js"></script>
    </body>
</html>
