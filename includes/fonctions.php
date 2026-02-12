<?php

function getAllProduits($pdo)
{
    $stmt = $pdo->query("SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit ORDER BY p.cree_le DESC");
    return $stmt->fetchAll();
}

function getLatestProduits($pdo, $limit = 5)
{
    $stmt = $pdo->prepare("SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit ORDER BY p.cree_le DESC LIMIT :limit");
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProduitById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit WHERE p.id_produit = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function getProduitsByLangage($pdo, $langage)
{
    $stmt = $pdo->prepare("SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit WHERE LOWER(p.langage) = LOWER(:langage) ORDER BY p.cree_le DESC");
    $stmt->execute([':langage' => $langage]);
    return $stmt->fetchAll();
}

function formatPrice($price)
{
    return number_format($price, 2, ',', ' ') . ' €';
}
