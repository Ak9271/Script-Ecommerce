<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

$langFilter = isset($_GET['lang']) ? $_GET['lang'] : null;

if ($langFilter) {
    $produits = getProduitsByLangage($pdo, $langFilter);
} else {
    $produits = getAllProduits($pdo);
}

include '../includes/header.php';
?>

<h1 class="page-title"><?= $langFilter ? 'Scripts ' . htmlspecialchars(ucfirst($langFilter)) : 'Tous les Scripts' ?>
</h1>

<?php if (!empty($produits)): ?>
    <div class="all-products-grid">
        <?php foreach ($produits as $produit): ?>
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

<?php include '../includes/footer.php'; ?>