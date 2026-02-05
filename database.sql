SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id`INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL, 
    `role` ENUM('user', 'admin') DEFAULT 'user',
    `cree_le` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `produits`;
CREATE TABLE `produits` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `prix` DECIMAL(10,2) NOT NULL,
    `image` VARCHAR(255),
    `categorie` VARCHAR(50) DEFAULT 'General',
    `cree_le` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_produit` INT NOT NULL,
    `quantite` INT DEFAULT 0,
    FOREIGN KEY (`id_produit`) REFERENCES `produits`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `factures`;
CREATE TABLE `factures` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `date_commande` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `montant_total` DECIMAL(10,2) NOT NULL,
    `statut` ENUM('en attente', 'payee', 'envoyee', 'annulee') DEFAULT 'en attente',
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE `commandes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `id_facture` INT NOT NULL,
    `id_produit` INT NOT NULL,
    `quantite` INT NOT NULL,
    `prix_unitaire` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
    FOREIGN KEY (`id_facture`) REFERENCES `factures`(`id`),
    FOREIGN KEY (`id_produit`) REFERENCES `produits`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;