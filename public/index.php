<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$latestProduits = getLatestProduits($pdo, 5);

include '../includes/header.php';
?>

<section class="hero-section">
    <h1>Tagline describing your e-shop</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac
        neque.</p>
    <div class="hero-buttons">
        <a href="produits.php" class="btn-shop btn-shop-primary">SHOP SALES</a>
        <a href="produits.php" class="btn-shop btn-shop-outline">ALL PRODUCTS</a>
    </div>
    <div class="carousel-dots">
        <span class="active"></span>
        <span></span>
    </div>
</section>

<section class="categories-section">
    <div class="categories-grid">
        <a href="produits.php" class="category-card">
            <div class="category-img">
                <i class="fas fa-fire"></i>
            </div>
            <h4>Bestsellers</h4>
        </a>
        <a href="produits.php" class="category-card">
            <div class="category-img">
                <i class="fas fa-leaf"></i>
            </div>
            <h4>Seasonal</h4>
        </a>
        <a href="produits.php" class="category-card">
            <div class="category-img">
                <i class="fas fa-th-large"></i>
            </div>
            <h4>Category</h4>
        </a>
        <a href="produits.php" class="category-card">
            <div class="category-img">
                <i class="fas fa-tags"></i>
            </div>
            <h4>Outlet</h4>
        </a>
    </div>
</section>

<section class="products-section">
    <div class="section-header">
        <h2>New products!</h2>
        <a href="produits.php">BROWSE ALL PRODUCTS →</a>
    </div>

    <?php if (!empty($latestProduits)): ?>
        <div class="products-grid">
            <?php foreach ($latestProduits as $produit): ?>
                <a href="detail_produit.php?id=<?= $produit['id_produit'] ?>" class="product-card">
                    <div class="product-img">
                        <?php if (!empty($produit['image'])): ?>
                            <!-- Fixed path to uploads -->
                            <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>"
                                alt="<?= htmlspecialchars($produit['nom']) ?>">
                        <?php else: ?>
                            <i class="fas fa-image"></i>
                        <?php endif; ?>
                        <span class="sale-badge">SALE</span>
                    </div>
                    <h5><?= htmlspecialchars($produit['nom']) ?></h5>
                    <p class="product-desc"><?= htmlspecialchars($produit['categorie'] ?? 'General') ?></p>
                    <p class="product-price"><?= formatPrice($produit['prix']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p>Aucun produit disponible pour le moment.</p>
        </div>
    <?php endif; ?>
</section>

<?php include '../includes/footer.php'; ?>