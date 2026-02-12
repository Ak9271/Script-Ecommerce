<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $produit = getProduitById($pdo, $id);
}

if (!isset($produit) || !$produit) {
    die("Produit introuvable.");
}

include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <?php if (!empty($produit['image'])): ?>
                <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>" class="img-fluid rounded"
                    alt="<?= htmlspecialchars($produit['nom']) ?>">
            <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center p-5 rounded" style="height: 400px;">
                    <i class="fas fa-image fa-3x text-muted"></i>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1>
                <?= htmlspecialchars($produit['nom']) ?>
            </h1>
            <p class="text-muted">
                <?= htmlspecialchars($produit['categorie'] ?? 'General') ?>
            </p>
            <h3 class="text-primary">
                <?= formatPrice($produit['prix']) ?>
            </h3>
            <p class="mt-4">
                <?= nl2br(htmlspecialchars($produit['description'])) ?>
            </p>

            <a href="#" class="btn btn-dark btn-lg mt-3">
                <i class="fas fa-shopping-cart"></i> Ajouter au panier
            </a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>