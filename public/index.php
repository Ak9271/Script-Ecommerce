<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$latestProduits = getLatestProduits($pdo, 5);

include '../includes/header.php';
?>

<section class="hero-section">
    <h1>Des scripts prêts à l'emploi, dans tous les langages</h1>
    <p>Découvrez notre collection de scripts Python, JavaScript, PHP, Bash, C# et bien plus. Téléchargez et intégrez-les
        directement dans vos projets.</p>
    <div class="hero-buttons">
        <a href="produits.php" class="btn-shop btn-shop-primary">EXPLORER LES SCRIPTS</a>
        <a href="produits.php" class="btn-shop btn-shop-outline">VOIR TOUT</a>
    </div>
    <div class="carousel-dots">
        <span class="active"></span>
        <span></span>
    </div>
</section>

<section class="categories-section">
    <div class="categories-grid">
        <a href="produits.php?lang=python" class="category-card">
            <div class="category-img">
                <i class="fab fa-python"></i>
            </div>
            <h4>Python</h4>
        </a>
        <a href="produits.php?lang=javascript" class="category-card">
            <div class="category-img">
                <i class="fab fa-js-square"></i>
            </div>
            <h4>JavaScript</h4>
        </a>
        <a href="produits.php?lang=php" class="category-card">
            <div class="category-img">
                <i class="fab fa-php"></i>
            </div>
            <h4>PHP</h4>
        </a>
        <a href="produits.php?lang=bash" class="category-card">
            <div class="category-img">
                <i class="fas fa-terminal"></i>
            </div>
            <h4>Bash</h4>
        </a>
    </div>
</section>

<section class="products-section">
    <div class="section-header">
        <h2>Derniers scripts ajoutés</h2>
        <a href="produits.php">VOIR TOUS LES SCRIPTS →</a>
    </div>

    <?php if (!empty($latestProduits)): ?>
        <div class="products-grid">
            <?php foreach ($latestProduits as $produit): ?>
                <a href="detail_produit.php?id=<?= $produit['id_produit'] ?>" class="product-card">
                    <div class="product-img">
                        <?php if (!empty($produit['image'])): ?>
                            <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>"
                                alt="<?= htmlspecialchars($produit['nom']) ?>">
                        <?php else: ?>
                            <i class="fas fa-file-code"></i>
                        <?php endif; ?>
                        <span class="lang-badge"><?= htmlspecialchars($produit['langage'] ?? 'PHP') ?></span>
                    </div>
                    <h5><?= htmlspecialchars($produit['nom']) ?></h5>
                    <p class="product-desc"><?= htmlspecialchars($produit['categorie'] ?? 'General') ?> ·
                        v<?= htmlspecialchars($produit['version'] ?? '1.0') ?></p>
                    <p class="product-price"><?= formatPrice($produit['prix']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-file-code"></i>
            <p>Aucun script disponible pour le moment.</p>
        </div>
    <?php endif; ?>
</section>

<?php include '../includes/footer.php'; ?>