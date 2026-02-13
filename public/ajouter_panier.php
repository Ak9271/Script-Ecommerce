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

if (isset($_SESSION['panier'][$id])) {
    $_SESSION['panier'][$id]++;
} else {
    $_SESSION['panier'][$id] = 1;
}

// Redirect back to the previous page if possible, otherwise products
$redirect = $_SERVER['HTTP_REFERER'] ?? 'produits.php';
if (strpos($redirect, 'ajouter_panier.php') !== false) {
    $redirect = 'produits.php';
}

header('Location: ' . $redirect);
exit;
