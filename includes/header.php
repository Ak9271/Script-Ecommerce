<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScriptShop - Vente de Scripts PHP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Script-Ecommerce/assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/Script-Ecommerce/public/index.php"><i class="fas fa-code"></i> ScriptShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/Script-Ecommerce/public/index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Script-Ecommerce/public/produits.php">Produits</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/Script-Ecommerce/public/panier.php">
                        <i class="fas fa-shopping-cart"></i> Panier
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> Mon Compte
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                        <li><a class="dropdown-item" href="/Script-Ecommerce/admin/dashboard.php">Admin Dashboard</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="/Script-Ecommerce/public/logout.php">Déconnexion</a></li>
                            </ul>
                        </li>
                <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Script-Ecommerce/public/login.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Script-Ecommerce/public/register.php">Inscription</a>
                        </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-4">
