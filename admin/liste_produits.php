<?php
session_start();
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}

$produits = getAllProduits($pdo);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scripts - Admin ScriptShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <i class="fas fa-code"></i>
            <span>ScriptShop</span>
        </div>
        <nav class="admin-nav">
            <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="liste_produits.php" class="active"><i class="fas fa-file-code"></i> Scripts</a>
            <a href="ajout_produits.php"><i class="fas fa-plus-circle"></i> Ajouter</a>
            <a href="liste_users.php"><i class="fas fa-users"></i> Utilisateurs</a>
        </nav>
        <div class="admin-sidebar-footer">
            <a href="../public/index.php"><i class="fas fa-arrow-left"></i> Retour au site</a>
            <a href="../public/logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </div>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <h1>Gestion des Scripts</h1>
            <a href="ajout_produits.php" class="btn-shop btn-shop-primary"><i class="fas fa-plus"></i> Ajouter</a>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="auth-success">
                <i class="fas fa-check-circle"></i>
                <?php
                    $msgs = [
                        'added' => 'Script ajouté avec succès.',
                        'updated' => 'Script modifié avec succès.',
                        'deleted' => 'Script supprimé avec succès.'
                    ];
                    echo $msgs[$_GET['success']] ?? 'Opération réussie.';
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($produits)): ?>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Langage</th>
                            <th>Version</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produits as $p): ?>
                            <tr>
                                <td><?= $p['id_produit'] ?></td>
                                <td>
                                    <div class="product-name-cell">
                                        <?php if (!empty($p['image'])): ?>
                                            <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" alt="">
                                        <?php else: ?>
                                            <div class="mini-placeholder"><i class="fas fa-file-code"></i></div>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($p['nom']) ?>
                                    </div>
                                </td>
                                <td><span class="lang-badge lang-badge-sm"><?= htmlspecialchars($p['langage'] ?? 'PHP') ?></span></td>
                                <td>v<?= htmlspecialchars($p['version'] ?? '1.0') ?></td>
                                <td><?= htmlspecialchars($p['categorie'] ?? 'General') ?></td>
                                <td><?= formatPrice($p['prix']) ?></td>
                                <td><?= $p['quantite'] ?? 0 ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="modif_produit.php?id=<?= $p['id_produit'] ?>" class="btn-action btn-edit" title="Modifier">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="supp_produit.php?id=<?= $p['id_produit'] ?>" class="btn-action btn-delete" title="Supprimer"
                                           onclick="return confirm('Supprimer ce script ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-file-code"></i>
                <p>Aucun script pour le moment.</p>
                <a href="ajout_produits.php" class="btn-shop btn-shop-primary" style="margin-top:16px;display:inline-block;">Ajouter un script</a>
            </div>
        <?php endif; ?>
    </main>
</div>

</body>
</html>
