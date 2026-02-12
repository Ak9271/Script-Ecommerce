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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fixed path to be relative -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header>
        <div class="top-header">
            <!-- Relative link to home -->
            <a href="../public/index.php" class="logo">
                <i class="fas fa-code"></i>
                ScriptShop
            </a>

            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search products...">
            </div>

            <div class="header-icons">
                <a href="#">
                    <i class="fas fa-heart"></i>
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="../public/logout.php">
                        <i class="fas fa-user"></i> Mon Compte
                    </a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="../admin/dashboard.php">
                            <i class="fas fa-cog"></i>
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="../public/login.php">
                        <i class="fas fa-user"></i> Login
                    </a>
                <?php endif; ?>
                <a href="../public/panier.php" class="cart-badge">
                    <i class="fas fa-shopping-bag"></i>
                    <span>0</span>
                </a>
            </div>
        </div>

        <nav class="main-nav">
            <!-- Relative links -->
            <a href="../public/produits.php">Products</a>
            <a href="../public/produits.php">SALE</a>
            <a href="#">Inspiration</a>
            <a href="#">Brands</a>
            <a href="#">Outlet</a>
            <a href="#">Shipping</a>
            <a href="#">Returns & Warranty</a>
            <a href="../public/a_propos.php">Contact</a>
        </nav>
    </header>

    <main>