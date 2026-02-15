<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$siteName = "ScriptShop";
$currentYear = date("Y");

include '../includes/header.php';
?>

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
