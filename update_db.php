<?php
require_once 'config/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS favoris (
        id_user INT NOT NULL,
        id_produit INT NOT NULL,
        cree_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id_user, id_produit),
        FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
        FOREIGN KEY (id_produit) REFERENCES produits(id_produit) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "<h1>Mise à jour réussie !</h1>";
    echo "<p>La table 'favoris' a été créée avec succès.</p>";
    echo "<a href='public/index.php'>Retour au site</a>";
} catch (PDOException $e) {
    echo "<h1>Erreur</h1>";
    echo "<p>Erreur lors de la création de la table : " . $e->getMessage() . "</p>";
}
?>