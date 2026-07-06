<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Portfolio — David Atse</title>
        <meta name="description" content="David Atse — Développeur web & créatif digital. Conception de sites web modernes, retouche photo et montage vidéo.">
        <meta property="og:title" content="Portfolio — David Atse">
        <meta property="og:description" content="Développeur web passionné, je conçois des sites web et des applications modernes, performantes et centrées sur l'utilisateur.">
        <meta property="og:type" content="website">
        <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/style.css?v=2">
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
                <div class="status-badge">
                    <span class="status-dot"></span>
                    Disponible pour projets
                </div>
                <p class="hero-tag">Développeur & Créatif Digital</p>
                <h1 class="hero-title">Je suis<br><span class="accent">David Atse</span></h1>
                <p class="hero-subtitle">Je conçois des expériences web modernes et impactantes — du code propre, un design soigné, et des visuels qui marquent les esprits.</p>
                <div class="hero-ctas">
                    <a href="#services" class="btn-primary">Voir mes projets</a>
                    <a href="#cv-section" class="btn-outline">Me contacter</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="photo-frame">
                    <div class="photo-deco-ring"></div>
                    <div class="photo-inner">
                        <img src="assets/image/télécharger.png" alt="David Atse">
                    </div>
                    <div class="photo-badge">Open to work</div>
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
            <p class="section-label reveal">Ce que je fais</p>
            <h2 class="section-title reveal">Mes <span>Services</span></h2>
            <p class="section-intro reveal">Chaque projet est une opportunité de créer quelque chose d'unique. Clique sur une carte pour explorer mes réalisations.</p>
            <div class="services-grid">

                <a href="pages/web.php" class="service-card reveal">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <h3 class="service-name">Web Design</h3>
                    <p class="service-desc">
                        Création de sites web modernes, responsives et performants. De la landing page au portfolio complet, chaque pixel est pensé pour l'impact.
                    </p>
                    <span class="service-link">Explorer →</span>
                </a>

                <a href="pages/photoshop.php" class="service-card reveal" id="projets-photo">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                    </div>
                    <h3 class="service-name">Photoshop & Retouche</h3>
                    <p class="service-desc">
                        Retouche photo professionnelle, création de visuels percutants et amélioration d'images pour un rendu esthétique et de haute qualité.
                    </p>
                    <span class="service-link">Explorer →</span>
                </a>

                <a href="pages/video.php" class="service-card reveal" id="projets-video">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                    </div>
                    <h3 class="service-name">Montages Vidéo</h3>
                    <p class="service-desc">
                        Montage créatif et storytelling vidéo. Des contenus qui captivent et engagent ton audience dès la première seconde.
                    </p>
                    <span class="service-link">Explorer →</span>
                </a>

                <a href="pages/certificats.php" class="service-card reveal" id="projets-certificats">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <line x1="10" y1="9" x2="8" y2="9" />
                        </svg>
                    </div>
                    <h3 class="service-name">Certificats</h3>
                    <p class="service-desc">
                        Certifications officielles et preuves tangibles de mon expertise dans le développement web et le design digital.
                    </p>
                    <span class="service-link">Explorer →</span>
                </a>

            </div>
        </section>

        <!-- ABOUT -->
        <section id="about">
            <div class="about-visual reveal">
                <div class="about-photo">
                    <img src="assets/image/télécharger (1).png" alt="David Atse">
                </div>
                <div class="about-exp-badge">
                    <span class="about-exp-num">2+</span>
                    <span class="about-exp-text">ans d'expérience</span>
                </div>
            </div>

            <div class="about-text reveal">
                <p class="section-label">Qui suis-je ?</p>
                <h2 class="section-title" style="margin-bottom: 1.5rem;">Développeur & Créatif<br><span>Digital</span></h2>

                <p>
                    Je suis <strong style="color: var(--white);">David Atse</strong>, développeur web et créatif digital basé en Côte d'Ivoire, passionné par la conception d'expériences numériques modernes et impactantes.
                </p>
                <p>
                    Je combine développement web, design visuel et montage vidéo pour livrer des projets complets — de l'interface jusqu'au contenu. J'ai notamment conçu des plateformes web dynamiques, des identités visuelles et des contenus vidéo engageants pour des clients réels.
                </p>
                <p>
                    Mon objectif : évoluer vers la création de produits digitaux innovants à grande échelle, en alliant performance technique, design soigné et expérience utilisateur.
                </p>

                <!-- TIMELINE -->
                <div class="timeline">
                    <div class="timeline-item">
                        <span class="timeline-year">2022</span>
                        <div class="timeline-content">
                            <strong>Début du développement web</strong>
                            <p>Premiers projets HTML/CSS/JS, découverte du PHP et des bases du développement.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-year">2023</span>
                        <div class="timeline-content">
                            <strong>Projets réels & créativité</strong>
                            <p>Premiers clients, création de sites dynamiques, retouche photo et montages vidéo professionnels.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-year">2024</span>
                        <div class="timeline-content">
                            <strong>Montée en compétences</strong>
                            <p>Laravel, UI/UX avancé, certifications obtenues et développement de ce portfolio.</p>
                        </div>
                    </div>
                </div>

                <div class="skills-list">
                    <span class="skill-pill">HTML / CSS</span>
                    <span class="skill-pill">JavaScript</span>
                    <span class="skill-pill">PHP</span>
                    <span class="skill-pill skill-pill--laravel">Laravel</span>
                    <span class="skill-pill">CapCut</span>
                    <span class="skill-pill">Adobe Photoshop</span>
                    <span class="skill-pill">UI / UX</span>
                </div>
            </div>
        </section>

        <!-- VALEURS -->
        <section id="valeurs">
            <p class="section-label reveal" style="justify-content:center;">Ce qui me définit</p>
            <h2 class="section-title reveal" style="text-align:center;">Pourquoi travailler <span>avec moi ?</span></h2>
            <div class="valeurs-grid">
                <div class="valeur-card reveal">
                    <div class="valeur-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3>Performance</h3>
                    <p>Code propre, chargement rapide et interfaces fluides. Je ne livre pas juste quelque chose qui fonctionne — je livre quelque chose qui impressionne.</p>
                </div>
                <div class="valeur-card reveal">
                    <div class="valeur-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/></svg>
                    </div>
                    <h3>Créativité</h3>
                    <p>Chaque projet est traité comme une œuvre unique. Design, vidéo ou code — j'apporte une vision artistique à tout ce que je touche.</p>
                </div>
                <div class="valeur-card reveal">
                    <div class="valeur-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3>Engagement</h3>
                    <p>Disponible, réactif et toujours à l'écoute. Je m'implique pleinement dans chaque projet comme si c'était le mien.</p>
                </div>
            </div>
        </section>

        <!-- CV DOWNLOAD -->
        <section id="cv-section">
            <div class="cv-inner reveal">
                <p class="section-label" style="justify-content: center;">Travaillons ensemble</p>
                <h2 class="section-title">Prêt à <span>collaborer ?</span></h2>
                <p>Tu as un projet web, une idée créative ou tu cherches un développeur motivé ? Contacte-moi — je réponds rapidement.</p>
                <div class="cv-actions">
                    <a href="assets/files/CV ATSE AKPOSSO DAVID EMMANUEL YANNIS.pdf" download class="btn-primary">↓ Télécharger le CV</a>
                    <a href="mailto:daatsey24@gmail.com" class="btn-outline">✉ M'envoyer un mail</a>
                </div>
                <div class="cv-socials">
                    <a href="https://github.com/DavidAtse" target="_blank" rel="noopener noreferrer">GitHub</a>
                    <span class="cv-sep">·</span>
                    <a href="https://www.linkedin.com/in/david-atse-26a1b9356/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                    <span class="cv-sep">·</span>
                    <a href="https://www.instagram.com/iam_dvvid/" target="_blank" rel="noopener noreferrer">Instagram</a>
                    <span class="cv-sep">·</span>
                    <a href="https://www.tiktok.com/@iamdvvid" target="_blank" rel="noopener noreferrer">TikTok</a>
                </div>
            </div>
        </section>

        <?php include("includes/footer.php") ?>
        <script src="assets/js/script.js"></script>
    </body>
</html>
