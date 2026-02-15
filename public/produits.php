<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$onlyAvailable = false;

$langFilter = isset($_GET['lang']) ? $_GET['lang'] : null;

if ($langFilter) {
    $produits = getProduitsByLangage($pdo, $langFilter, $onlyAvailable);
} else {
    $produits = getAllProduits($pdo, $onlyAvailable);
}

include '../includes/header.php';
?>

<h1 class="page-title"><?= $langFilter ? 'Scripts ' . htmlspecialchars(ucfirst($langFilter)) : 'Tous les Scripts' ?>
</h1>

<?php if (!empty($produits)): ?>
    <div class="all-products-grid">
        <?php foreach ($produits as $produit): ?>
            <div class="product-card" onclick="window.location.href='detail_produit.php?id=<?= $produit['id_produit'] ?>'">
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
                <p class="product-price">
                    <span><?= formatPrice($produit['prix']) ?></span>
                    <?php if (($produit['quantite'] ?? 0) > 0): ?>
                        <a href="ajouter_panier.php?id=<?= $produit['id_produit'] ?>" class="btn-shop btn-shop-primary btn-sm"
                            title="Ajouter au panier" onclick="event.stopPropagation();">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    <?php else: ?>
                        <span class="badge-out-of-stock" style="color: red; font-size: 0.8em; font-weight: bold;">Hors stock</span>
                    <?php endif; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="empty-state">
        <i class="fas fa-file-code"></i>
        <p>Aucun script disponible pour le moment.</p>
    </div>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>