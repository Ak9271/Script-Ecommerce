<?php
session_start();
require_once '../config/db.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=panier.php');
    exit;
}

$panier = $_SESSION['panier'] ?? [];


if (empty($panier)) {
    header('Location: panier.php');
    exit;
}

try {
    $pdo->beginTransaction();

    
    $total = 0;
    $produitsAchetes = [];

    
    $ids = array_keys($panier);
    if (empty($ids)) {
        throw new Exception("Panier vide.");
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT p.id_produit, p.prix, s.quantite as stock_disponible FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit WHERE p.id_produit IN ($placeholders)");
    $stmt->execute($ids);
    $produitsDb = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $produitsMap = [];
    foreach ($produitsDb as $p) {
        $produitsMap[$p['id_produit']] = $p;
    }

    foreach ($panier as $id_produit => $quantite) {
        if (!isset($produitsMap[$id_produit])) {
             throw new Exception("Produit ID $id_produit introuvable.");
        }
        
        $produit = $produitsMap[$id_produit];
        
        
        if ($produit['stock_disponible'] < $quantite) {
            throw new Exception("Stock insuffisant pour le produit ID $id_produit.");
        }

        $total += $produit['prix'] * $quantite;
        $produitsAchetes[] = [
            'id_produit' => $id_produit,
            'quantite' => $quantite,
            'prix_unitaire' => $produit['prix']
        ];
    }

    
    $stmtFacture = $pdo->prepare("INSERT INTO factures (id_user, montant_total, statut) VALUES (:id_user, :montant_total, 'payee')");
    $stmtFacture->execute([
        ':id_user' => $_SESSION['user_id'],
        ':montant_total' => $total
    ]);
    $id_facture = $pdo->lastInsertId();

    
    $stmtCommande = $pdo->prepare("INSERT INTO commandes (id_user, id_facture, id_produit, quantite, prix_unitaire) VALUES (:id_user, :id_facture, :id_produit, :quantite, :prix_unitaire)");
    $stmtStock = $pdo->prepare("UPDATE stock SET quantite = quantite - :quantite WHERE id_produit = :id_produit");

    foreach ($produitsAchetes as $item) {
        
        $stmtCommande->execute([
            ':id_user' => $_SESSION['user_id'],
            ':id_facture' => $id_facture,
            ':id_produit' => $item['id_produit'],
            ':quantite' => $item['quantite'],
            ':prix_unitaire' => $item['prix_unitaire']
        ]);

        
        $stmtStock->execute([
            ':quantite' => $item['quantite'],
            ':id_produit' => $item['id_produit']
        ]);
    }

    $pdo->commit();

    
    unset($_SESSION['panier']);

    
    header('Location: panier.php?success=commande_validee');
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    
    header('Location: panier.php?error=' . urlencode($e->getMessage()));
    exit;
}
