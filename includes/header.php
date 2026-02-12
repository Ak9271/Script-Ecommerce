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
    <title>ScriptShop - Marketplace de Scripts</title>
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
                <input type="text" placeholder="Rechercher un script...">
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
            <a href="../public/produits.php">Tous les Scripts</a>
            <a href="../public/produits.php?lang=python">Python</a>
            <a href="../public/produits.php?lang=javascript">JavaScript</a>
            <a href="../public/produits.php?lang=php">PHP</a>
            <a href="../public/produits.php?lang=bash">Bash</a>
            <a href="../public/produits.php?lang=csharp">C#</a>
            <a href="../public/a_propos.php">Contact</a>
        </nav>
    </header>

    <main>