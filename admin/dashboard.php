<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}

$totalProduits = $pdo->query("SELECT COUNT(*) FROM produits")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalCommandes = $pdo->query("SELECT COUNT(*) FROM commandes")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ScriptShop</title>
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
                <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
                <a href="liste_produits.php"><i class="fas fa-file-code"></i> Scripts</a>
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
                <h1>Dashboard</h1>
                <p>Bienvenue,
                    <?= htmlspecialchars($_SESSION['username']) ?>
                </p>
            </div>

            <div class="admin-stats">
                <div class="stat-card">
                    <i class="fas fa-file-code"></i>
                    <div>
                        <h3>
                            <?= $totalProduits ?>
                        </h3>
                        <p>Scripts</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <div>
                        <h3>
                            <?= $totalUsers ?>
                        </h3>
                        <p>Utilisateurs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-shopping-cart"></i>
                    <div>
                        <h3>
                            <?= $totalCommandes ?>
                        </h3>
                        <p>Commandes</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>