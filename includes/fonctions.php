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

function searchProduits($pdo, $query, $onlyAvailable = false)
{
    $sql = "SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit 
            WHERE (p.nom LIKE :query OR p.description LIKE :query OR p.langage LIKE :query)";
    
    if ($onlyAvailable) {
        $sql .= " AND s.quantite > 0";
    }
    $sql .= " ORDER BY p.cree_le DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':query' => '%' . $query . '%']);
    return $stmt->fetchAll();
}

function formatPrice($price)
{
    return number_format($price, 2, ',', ' ') . ' €';
}

function getFavoris($pdo, $userId)
{
    $stmt = $pdo->prepare("SELECT p.*, s.quantite FROM produits p LEFT JOIN stock s ON p.id_produit = s.id_produit INNER JOIN favoris f ON p.id_produit = f.id_produit WHERE f.id_user = :userId ORDER BY f.cree_le DESC");
    $stmt->execute([':userId' => $userId]);
    return $stmt->fetchAll();
}

function isFavori($pdo, $userId, $produitId)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM favoris WHERE id_user = :userId AND id_produit = :produitId");
    $stmt->execute([':userId' => $userId, ':produitId' => $produitId]);
    return $stmt->fetchColumn() > 0;
}

function toggleFavori($pdo, $userId, $produitId)
{
    if (isFavori($pdo, $userId, $produitId)) {
        $stmt = $pdo->prepare("DELETE FROM favoris WHERE id_user = :userId AND id_produit = :produitId");
        $stmt->execute([':userId' => $userId, ':produitId' => $produitId]);
        return false; 
    } else {
        $stmt = $pdo->prepare("INSERT INTO favoris (id_user, id_produit) VALUES (:userId, :produitId)");
        $stmt->execute([':userId' => $userId, ':produitId' => $produitId]);
        return true; 
    }
}
