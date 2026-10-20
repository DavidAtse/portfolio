# 🚀 Portfolio Personnel — David Atse

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/fr/docs/Web/JavaScript)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> Portfolio interactif et moderne conçu pour présenter mes projets en **développement web**, **création graphique / retouche photo**, et **montage vidéo**. Il intègre un **espace d'administration sécurisé** permettant la gestion dynamique des réalisations.

🔗 **Démo en ligne :** [davedev.alwaysdata.net/portfolio](https://davedev.alwaysdata.net/portfolio/)

---

## 📌 Sommaire

- [Aperçu & Fonctionnalités](#-fonctionnalités)
- [Stack Technique](#-stack-technique)
- [Architecture du Projet](#-architecture-du-projet)
- [Sécurité & Bonnes Pratiques](#-sécurité--bonnes-pratiques)
- [Installation & Lancement Local](#-installation--lancement-local)
- [Déploiement en Production](#-déploiement-en-production)
- [Auteur & Contact](#-auteur--contact)

---

## ✨ Fonctionnalités

### 🎨 Expérience Utilisateur (Front-office)
- **Design moderne & immersif** : Thème sombre (*Dark theme*) soigné, typographies percutantes (*Bebas Neue*, *DM Sans*, *Space Mono*).
- **Interactivité fluide** : Curseur personnalisé animé avec anneau suiveur, animations de révélation au défilement (*Scroll Reveal*), et écran de chargement dynamique (*Loader*).
- **Navigation adaptative** : Barre de navigation sticky et responsive avec menu hamburger plein écran pour mobile.
- **Organisation par catégories de projets** :
  - 🌐 **Développement Web** (`/pages/web.php`) : Aperçu des sites, descriptions et liens directs vers les réalisations.
  - 🎬 **Montage Vidéo** (`/pages/video.php`) : Lecteur vidéo intégré pour visualiser les clips, promos et montages.
  - 📸 **Retouche Photo & Graphisme** (`/pages/photoshop.php`) : Galerie visuelle des affiches, retouches et maquettes.
  - 📜 **Certificats & Formations** (`/pages/certificats.php`) : Consultation et téléchargement des diplômes et certifications en PDF / images.
- **Section Contact & CV** : Téléchargement direct du CV au format PDF et liens vers les réseaux sociaux.

### 🛡️ Dashboard Administrateur (`/admin`)
- **Authentification sécurisée** : Accès protégé par mot de passe haché (`password_hash` avec `BCRYPT`).
- **Protection anti-brute force (Rate Limiting)** : Verrouillage temporaire après 5 tentatives infructueuses (15 minutes de blocage).
- **Protection CSRF** : Validation stricte des requêtes formulaires avec rotation de jetons de sécurité.
- **Tableau de bord statistique** : Compteurs en temps réel du nombre total de projets et de la répartition par catégorie.
- **Gestion dynamique des projets (CRUD)** :
  - **Ajout de projet** avec upload de médias (images `jpg`/`png`/`webp`, vidéos `mp4`/`webm`/`mov`, documents `pdf`).
  - Validation côté serveur des types MIME, des extensions autorisées et de la taille maximale (jusqu'à 100 Mo).
  - Renommage aléatoire sécurisé des fichiers téléversés pour prévenir tout risque d'écrasement ou d'exécution malveillante.
  - **Suppression avec nettoyage automatique** : Suppression simultanée en base de données et du fichier physique sur le disque.

---

## 🛠️ Stack Technique

| Domaine | Technologies |
|---|---|
| **Frontend** | HTML5, CSS3 personnalisé (variables CSS, Flexbox, Grid), JavaScript Vanilla (ES6+) |
| **Backend** | PHP 8.2+ (POO, PDO, Sessions sécurisées, CSRF) |
| **Base de données** | MySQL / MariaDB (Moteur InnoDB, encodage UTF-8mb4) |
| **Serveur Web** | Apache 2.4 (Modules `mod_rewrite`, `mod_headers`, `mod_fcgid`) |
| **Hébergement** | Alwaysdata / XAMPP pour l'environnement local |

---

## 📂 Architecture du Projet

```text
portfolioV1.1/
├── admin/                     # Espace d'administration
│   ├── add_project.php        # Formulaire d'ajout de projet + gestion de l'upload
│   ├── delete_project.php     # Suppression d'un projet et du fichier associé
│   ├── index.php              # Tableau de bord administrateur & statistiques
│   ├── login.php              # Page de connexion avec rate-limiting
│   └── logout.php             # Déconnexion et destruction de la session
├── assets/                    # Ressources statiques
│   ├── css/                   # Feuilles de style (admin, style, web, video, etc.)
│   ├── files/                 # Documents téléchargeables (CV PDF)
│   ├── image/                 # Images statiques et illustrations
│   └── js/                    # Scripts JavaScript interactifs
├── config/                    # Fichiers de configuration
│   ├── .htaccess              # Restriction d'accès direct
│   ├── admin.php              # Identifiants et hachage du compte administrateur
│   └── db.php                 # Connexion PDO multi-environnements (Local / Prod)
├── includes/                  # Composants PHP réutilisables
│   ├── .htaccess              # Restriction d'accès direct
│   ├── csrf.php               # Helpers de génération et validation de jetons CSRF
│   ├── footer.php             # Pied de page global
│   ├── loader.php             # Écran de chargement animé
│   └── navbar.php             # Barre de navigation responsive dynamique
├── pages/                     # Vues publiques par catégorie
│   ├── certificats.php        # Page des certifications
│   ├── photoshop.php          # Page des créations graphiques
│   ├── video.php              # Page des projets vidéo
│   └── web.php                # Page des projets web
├── uploads/                   # Répertoire de stockage des médias téléversés
├── .htaccess                  # En-têtes HTTP de sécurité & règles Apache
├── index.php                  # Page d'accueil principale du portfolio
├── portfolio_db.sql           # Schéma et données initiales de la base de données
└── README.md                  # Documentation du projet
```

---

## 🔒 Sécurité & Bonnes Pratiques

- **Prévention des injections SQL** : Utilisation stricte de requêtes préparées avec `PDO` et émulation désactivée (`ATTR_EMULATE_PREPARES => false`).
- **Protection XSS** : Échappement systématique des sorties utilisateur via `htmlspecialchars()` avec encodage UTF-8.
- **Protection CSRF** : Vérification des jetons sur l'ensemble des actions sensibles (`POST`).
- **En-têtes HTTP sécurisés** (configurés dans `.htaccess`) :
  - `X-Content-Type-Options: nosniff`
  - `X-Frame-Options: SAMEORIGIN`
  - `X-XSS-Protection: 1; mode=block`
  - `Referrer-Policy: strict-origin-when-cross-origin`
  - `Permissions-Policy: camera=(), microphone=(), geolocation=()`
- **Blocage de l'accès direct aux fichiers sensibles** :
  - Interdiction de navigation dans les répertoires (`Options -Indexes`).
  - Blocage Apache (`Require all denied`) sur les extensions sensibles (`.env`, `.sql`, `.md`, `.log`, `.git`) et les scripts internes de configuration.
- **Upload sécurisé** : Double vérification extension + type MIME réel (`mime_content_type`) et renommage des fichiers par hachage aléatoire cryptographique (`bin2hex(random_bytes(8))`).

---

## 💻 Installation & Lancement Local

### Prérequis
- [XAMPP](https://www.apachefriends.org/fr/index.html) (avec PHP 8.1+ et MySQL/MariaDB) ou équivalent (WAMP, Laragon, Docker).
- [Git](https://git-scm.com/).

### 1. Cloner le dépôt
Clone ce projet dans le répertoire web de ton serveur local (ex: `C:/xampp/htdocs/` sur Windows) :
```bash
cd C:/xampp/htdocs
git clone https://github.com/DavidAtse/portfolio.git
cd portfolio
```

### 2. Importer la base de données
1. Démarre **Apache** et **MySQL** depuis le panneau de contrôle XAMPP.
2. Ouvre **phpMyAdmin** (`http://localhost/phpmyadmin`).
3. Crée une nouvelle base de données nommée `portfolio_db`.
4. Rends-toi dans l'onglet **Importer**, sélectionne le fichier `portfolio_db.sql` situé à la racine du projet, puis valide.

### 3. Configurer les variables d'environnement (`.env`)
Copie le fichier d'exemple `.env.example` vers `.env` (ce fichier est ignoré par Git pour ne jamais exposer de mots de passe) :
```bash
cp .env.example .env
```
Génère ton propre hash de mot de passe administrateur avec PHP :
```bash
php -r "echo password_hash('VotreMotDePasseSecurise', PASSWORD_BCRYPT, ['cost' => 12]);"
```
Puis renseigne tes identifiants dans ton fichier `.env`.

### 4. Accéder à l'application
- **Site public :** `http://localhost/portfolio/`
- **Dashboard Admin :** `http://localhost/portfolio/admin/login.php`

---

## 🌐 Déploiement en Production

Les identifiants sensibles (base de données, compte administrateur) sont chargés dynamiquement depuis le fichier `.env` non versionné via `config/env.php`.

### Déploiement rapide avec Alwaysdata
1. Crée la base de données MySQL et importe `portfolio_db.sql` via le phpMyAdmin Alwaysdata.
2. Connecte-toi en SSH sur ton espace Alwaysdata et clone le dépôt :
   ```bash
   cd ~/www/portfolio
   git clone https://github.com/DavidAtse/portfolio.git .
   cp .env.example .env
   nano .env # Renseigne tes variables de production
   ```
3. Assure-toi que les droits du dossier `uploads/` permettent l'écriture :
   ```bash
   chmod 775 ~/www/portfolio/uploads
   ```

---

## 👨‍💻 Auteur & Contact

**David Atse**  
*Développeur Web & Créatif Digital*

- 🌐 **Portfolio :** [davedev.alwaysdata.net/portfolio](https://davedev.alwaysdata.net/portfolio/)
- 🐙 **GitHub :** [@DavidAtse](https://github.com/DavidAtse)
- 💼 **LinkedIn :** [David Atse](https://www.linkedin.com/in/david-atse-26a1b9356/)
- ✉️ **Email :** [daatsey24@gmail.com](mailto:daatsey24@gmail.com)

---

⭐ *Si ce projet vous plaît, n'hésitez pas à lui laisser une étoile sur GitHub !*
