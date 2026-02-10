<?php
require_once '../config/db.php';
include '../includes/header.php';
?>

<div class="jumbotron text-center bg-light p-5 mb-4 rounded-3">
    <h1 class="display-4">Bienvenue sur ScriptShop</h1>
    <p class="lead">Découvrez nos meilleurs scripts PHP pour vos projets web.</p>
    <a class="btn btn-primary btn-lg" href="produits.php" role="button">Voir les produits</a>
</div>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Derniers Ajouts</h2>
        <div class="alert alert-info">
            Aucun produit n'est disponible pour le moment. (La base de données doit être peuplée)
        </div>
        <!-- Ici nous afficherons les produits dynamiquement plus tard -->
    </div>
</div>

<?php
include '../includes/footer.php';
?>