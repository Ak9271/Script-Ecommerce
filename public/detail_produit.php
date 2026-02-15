<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $produit = getProduitById($pdo, $id);
}

if (!isset($produit) || !$produit) {
    die("Script introuvable.");
}

$isFavori = false;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    $isFavori = isFavori($pdo, $_SESSION['user_id'], $produit['id_produit']);
}

include '../includes/header.php';
?>

<div class="detail-container">
    <div class="detail-image">
        <?php if (!empty($produit['image'])): ?>
            <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
        <?php else: ?>
            <div class="detail-placeholder">
                <i class="fas fa-file-code"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="detail-info">
        <span class="lang-badge lang-badge-lg"><?= htmlspecialchars($produit['langage'] ?? 'PHP') ?></span>
        <div class="title-row">
            <h1><?= htmlspecialchars($produit['nom']) ?></h1>
            <a href="toggle_favoris.php?id=<?= $produit['id_produit'] ?>" class="btn-favori" title="<?= $isFavori ? 'Retirer des favoris' : 'Ajouter aux favoris' ?>">
                <i class="<?= $isFavori ? 'fas' : 'far' ?> fa-heart"></i>
            </a>
        </div>
        <p class="detail-meta"><?= htmlspecialchars($produit['categorie'] ?? 'General') ?> · Version
            <?= htmlspecialchars($produit['version'] ?? '1.0') ?>
        </p>
        <h3 class="detail-price"><?= formatPrice($produit['prix']) ?></h3>
        
        <p class="stock-info" style="color: <?= ($produit['quantite'] > 0) ? '#10b981' : '#ef4444' ?>; font-weight: bold; margin-bottom: 15px;">
            <?= ($produit['quantite'] > 0) ? '<i class="fas fa-check-circle"></i> En stock : ' . $produit['quantite'] : '<i class="fas fa-times-circle"></i> Rupture de stock' ?>
        </p>

        <p class="detail-description"><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
        
        <?php if (($produit['quantite'] ?? 0) > 0): ?>
            <a href="ajouter_panier.php?id=<?= $produit['id_produit'] ?>" class="btn-shop btn-shop-primary btn-lg">
                <i class="fas fa-cart-plus"></i> Ajouter au panier
            </a>
        <?php else: ?>
            <button class="btn-shop btn-shop-disabled btn-lg" disabled style="background-color: #ccc; cursor: not-allowed;">
                <i class="fas fa-ban"></i> Hors stock
            </button>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>