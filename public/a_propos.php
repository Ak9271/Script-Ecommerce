<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$siteName = "ScriptShop";
$currentYear = date("Y");

include '../includes/header.php';
?>

<style>
    .about-hero {
        padding: 80px 5%;
        text-align: center;
        background-color: var(--body-bg);
    }

    .about-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--text-color);
    }

    .about-hero span {
        color: var(--primary-color);
    }

    .about-hero p {
        max-width: 800px;
        margin: 0 auto;
        color: #999;
        font-size: 1.1rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        padding: 50px 5%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: var(--card-bg);
        padding: 40px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        transition: 0.3s;
    }

    .feature-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }

    .feature-card i {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .feature-card h3 {
        margin-bottom: 15px;
        font-size: 1.4rem;
        color: var(--text-color);
    }

    .feature-card p {
        color: #999;
        font-size: 0.95rem;
    }

    .cta-box {
        text-align: center;
        padding: 60px 5%;
    }

    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2rem;
        }
    }
</style>

<section class="about-hero">
    <h1>Votre Accélérateur de <span>Développement</span></h1>
    <p>Alliant une esthétique minimaliste à une performance technique de pointe, nous offrons aux particuliers et professionnels des scripts robustes et optimisés pour chaque ligne de code.</p>
</section>

<section class="features-grid">
    <div class="feature-card">
        <i class="fas fa-bolt"></i>
        <h3>Scripts Prêts à l'Emploi</h3>
        <p>Ne perdez plus de temps à réinventer la roue. Nos scripts sont plug-and-play, testés et prêts à être intégrés dans vos projets.</p>
    </div>
    <div class="feature-card">
        <i class="fas fa-shield-alt"></i>
        <h3>Sécurité Maximale</h3>
        <p>Chaque script est audité pour garantir une sécurité optimale. Vos données et celles de vos utilisateurs sont notre priorité.</p>
    </div>
    <div class="feature-card">
        <i class="fas fa-code"></i>
        <h3>Code Propre & Documenté</h3>
        <p>Des standards de code élevés, une indentation parfaite et une documentation claire pour faciliter la personnalisation.</p>
    </div>
</section>

<div class="cta-box">
    <a href="produits.php" class="btn-shop btn-shop-primary">Voir nos Scripts</a>
</div>

<?php include '../includes/footer.php'; ?>
