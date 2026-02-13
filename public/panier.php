<?php
require_once '../config/db.php';
require_once '../includes/fonctions.php';

session_start();

$panier = $_SESSION['panier'] ?? [];
$produitsPanier = [];
$total = 0;

if (!empty($panier)) {
    $ids = array_keys($panier);
    if (!empty($ids)) {
        // Fetch products in cart
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id_produit IN ($placeholders)");
        $stmt->execute($ids);
        $produitsDb = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Map products and calculate total
        foreach ($produitsDb as $produit) {
            $id = $produit['id_produit'];
            $qty = $panier[$id];
            $produit['qty_panier'] = $qty;
            $produit['total_item'] = $produit['prix'] * $qty;
            $produitsPanier[] = $produit;
            $total += $produit['total_item'];
        }
    }
}

include '../includes/header.php';
?>

<div class="cart-container">
    <h1 class="page-title">Mon Panier</h1>

    <?php if (empty($produitsPanier)): ?>
        <div class="empty-state">
            <i class="fas fa-shopping-basket"></i>
            <p>Votre panier est vide.</p>
            <a href="produits.php" class="btn-shop btn-shop-primary" style="margin-top: 20px;">Continuer mes achats</a>
        </div>
    <?php else: ?>
        <div class="cart-content">
            <div class="cart-items">
                <?php foreach ($produitsPanier as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-img">
                            <?php if (!empty($item['image'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($item['image']) ?>"
                                    alt="<?= htmlspecialchars($item['nom']) ?>">
                            <?php else: ?>
                                <i class="fas fa-file-code"></i>
                            <?php endif; ?>
                        </div>
                        <div class="cart-item-details">
                            <h3>
                                <?= htmlspecialchars($item['nom']) ?>
                            </h3>
                            <p class="text-muted">
                                <?= htmlspecialchars($item['categorie']) ?> · v
                                <?= htmlspecialchars($item['version']) ?>
                            </p>
                        </div>
                        <div class="cart-item-price">
                            <?= formatPrice($item['prix']) ?>
                        </div>
                        <div class="cart-item-actions">
                            <a href="retirer_panier.php?id=<?= $item['id_produit'] ?>" class="btn-remove" title="Retirer">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Récapitulatif</h3>
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span>
                        <?= formatPrice($total) ?>
                    </span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>
                        <?= formatPrice($total) ?>
                    </span>
                </div>
                <button class="btn-shop btn-shop-primary btn-block">Passer la commande</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .cart-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 40px;
        min-height: 60vh;
    }

    .cart-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
    }

    .cart-items {
        background: #121212;
        border-radius: 16px;
        border: 1px solid #2d2d2d;
        overflow: hidden;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #2d2d2d;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-img {
        width: 60px;
        height: 60px;
        background: #000;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        overflow: hidden;
    }

    .cart-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-img i {
        font-size: 1.5rem;
        color: #444;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-details h3 {
        font-size: 1rem;
        color: #fff;
        margin-bottom: 4px;
    }

    .text-muted {
        color: #888;
        font-size: 0.85rem;
    }

    .cart-item-price {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.1rem;
        margin-right: 20px;
    }

    .btn-remove {
        color: #ef4444;
        transition: color 0.2s;
    }

    .btn-remove:hover {
        color: #dc2626;
    }

    .cart-summary {
        background: #121212;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #2d2d2d;
        height: fit-content;
    }

    .cart-summary h3 {
        margin-bottom: 20px;
        color: #fff;
        font-size: 1.2rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #ccc;
        padding-bottom: 15px;
        border-bottom: 1px solid #2d2d2d;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-bottom: 25px;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
    }

    .btn-block {
        width: 100%;
        text-align: center;
    }

    @media (max-width: 768px) {
        .cart-content {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php include '../includes/footer.php'; ?>