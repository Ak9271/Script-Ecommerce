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
        <h1><?= htmlspecialchars($produit['nom']) ?></h1>
        <p class="detail-meta"><?= htmlspecialchars($produit['categorie'] ?? 'General') ?> · Version
            <?= htmlspecialchars($produit['version'] ?? '1.0') ?>
        </p>
        <h3 class="detail-price"><?= formatPrice($produit['prix']) ?></h3>
        <p class="detail-description"><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
        <a href="ajouter_panier.php?id=<?= $produit['id_produit'] ?>" class="btn-shop btn-shop-primary btn-lg">
            <i class="fas fa-cart-plus"></i> Ajouter au panier
        </a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>