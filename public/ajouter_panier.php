<?php
session_start();
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];
$produit = getProduitById($pdo, $id);

if (!$produit) {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$id_produit = $produit['id_produit'];
$current_qty = $_SESSION['panier'][$id_produit] ?? 0;
$stock_disponible = $produit['quantite'] ?? 0;

if ($current_qty < $stock_disponible) {
    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit]++;
    } else {
        $_SESSION['panier'][$id_produit] = 1;
    }
} else {
}

$redirect = $_SERVER['HTTP_REFERER'] ?? 'produits.php';
if (strpos($redirect, 'ajouter_panier.php') !== false) {
    $redirect = 'produits.php';
}

header('Location: ' . $redirect);
exit;
