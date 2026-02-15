<?php

function getAllProduits($pdo, $onlyAvailable = false)
{
    $sql = "SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit";
    if ($onlyAvailable) {
        $sql .= " WHERE s.quantite > 0";
    }
    $sql .= " ORDER BY p.cree_le DESC";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function getLatestProduits($pdo, $limit = 5, $onlyAvailable = false)
{
    $sql = "SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit";
    if ($onlyAvailable) {
        $sql .= " WHERE s.quantite > 0";
    }
    $sql .= " ORDER BY p.cree_le DESC LIMIT :limit";

    $stmt = $pdo->prepare($sql);
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

function getProduitsByLangage($pdo, $langage, $onlyAvailable = false)
{
    $sql = "SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit WHERE LOWER(p.langage) = LOWER(:langage)";
    if ($onlyAvailable) {
        $sql .= " AND s.quantite > 0";
    }
    $sql .= " ORDER BY p.cree_le DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':langage' => $langage]);
    return $stmt->fetchAll();
}

function formatPrice($price)
{
    return number_format($price, 2, ',', ' ') . ' €';
}
