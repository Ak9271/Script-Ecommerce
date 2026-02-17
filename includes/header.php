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

            <form action="../public/produits.php" method="GET" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="q" placeholder="Rechercher un script..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            </form>

            <div class="header-icons">
                <a href="../public/a_propos.php">
                    <i class="fas fa-info-circle"></i> À propos
                </a>
                <a href="../public/favoris.php">
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
                    <span><?= array_sum($_SESSION['panier'] ?? []) ?></span>

                </a>
            </div>
        </div>

        <nav class="main-nav">
            <div class="nav-container">
                <a href="../public/produits.php" class="<?= !isset($_GET['lang']) ? 'active' : '' ?>">Tous</a>
                <a href="../public/produits.php?lang=PHP" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'PHP') ? 'active' : '' ?>">PHP</a>
                <a href="../public/produits.php?lang=Python" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Python') ? 'active' : '' ?>">Python</a>
                <a href="../public/produits.php?lang=JavaScript" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'JavaScript') ? 'active' : '' ?>">JavaScript</a>
                <a href="../public/produits.php?lang=Bash" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Bash') ? 'active' : '' ?>">Bash</a>
                <a href="../public/produits.php?lang=C%23" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'C#') ? 'active' : '' ?>">C#</a>
                <a href="../public/produits.php?lang=Java" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Java') ? 'active' : '' ?>">Java</a>
                <a href="../public/produits.php?lang=Ruby" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Ruby') ? 'active' : '' ?>">Ruby</a>
                <a href="../public/produits.php?lang=Go" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Go') ? 'active' : '' ?>">Go</a>
                <a href="../public/produits.php?lang=Rust" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'Rust') ? 'active' : '' ?>">Rust</a>
                <a href="../public/produits.php?lang=TypeScript" class="<?= (isset($_GET['lang']) && $_GET['lang'] === 'TypeScript') ? 'active' : '' ?>">TypeScript</a>
            </div>
        </nav>
    </header>

    <main>