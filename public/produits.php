<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$produits = getAllProduits($pdo);

include '../includes/header.php';
?>

<h1 class="page-title">All Products</h1>

<?php if (!empty($produits)): ?>
    <div class="all-products-grid">
        <?php foreach ($produits as $produit): ?>
            <a href="detail_produit.php?id=<?= $produit['id_produit'] ?>" class="product-card">
                <div class="product-img">
                    <?php if (!empty($produit['image'])): ?>
                        <!-- Fixed path to uploads -->
                        <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>"
                            alt="<?= htmlspecialchars($produit['nom']) ?>">
                    <?php else: ?>
                        <i class="fas fa-image"></i>
                    <?php endif; ?>
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

<?php include '../includes/footer.php'; ?>