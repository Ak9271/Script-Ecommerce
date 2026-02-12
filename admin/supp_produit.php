<?php
session_start();
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $produit = getProduitById($pdo, $id);
    if ($produit) {
        if (!empty($produit['image']) && file_exists('../uploads/' . $produit['image'])) {
            unlink('../uploads/' . $produit['image']);
        }

        $stmtStock = $pdo->prepare("DELETE FROM stock WHERE id_produit = :id");
        $stmtStock->execute([':id' => $id]);

        $stmt = $pdo->prepare("DELETE FROM produits WHERE id_produit = :id");
        $stmt->execute([':id' => $id]);

        header('Location: liste_produits.php?success=deleted');
        exit;
    }
}

header('Location: liste_produits.php?error=notfound');
exit;
