<?php
require_once 'config/db.php';

try {
    
    $stmt = $pdo->query("SHOW COLUMNS FROM produits LIKE 'fichier_script'");
    $exists = $stmt->fetch();

    if (!$exists) {
        $sql = "ALTER TABLE produits ADD COLUMN fichier_script VARCHAR(255) DEFAULT NULL AFTER image";
        $pdo->exec($sql);
        echo "<h1>Succès</h1><p>La colonne 'fichier_script' a été ajoutée à la table 'produits'.</p>";
    } else {
        echo "<h1>Information</h1><p>La colonne 'fichier_script' existe déjà.</p>";
    }
    
    
    $uploadDir = __DIR__ . '/uploads/scripts';
    if (!file_exists($uploadDir)) {
        if (mkdir($uploadDir, 0755, true)) {
            echo "<p>Dossier 'uploads/scripts' créé.</p>";
        } else {
            echo "<p style='color:red'>Erreur lors de la création du dossier 'uploads/scripts'.</p>";
        }
    }

    echo "<p><a href='admin/ajout_produits.php'>Retour à l'admin</a></p>";

} catch (PDOException $e) {
    echo "<h1>Erreur</h1><p>" . $e->getMessage() . "</p>";
}
?>