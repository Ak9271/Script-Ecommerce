# Script-Ecommerce

<<<<<<< HEAD
PUSH
=======
Projet de site e-commerce développé en PHP sans framework, utilisant une architecture MVC simplifiée.

## 🚀 Fonctionnalités Actuelles

### Partie Publique
- **Authentification** : Système de connexion et d'inscription pour les clients.
- **Catalogue** : Affichage des produits avec détails (nom, prix, description, image).
- **Panier** : Gestion du panier (ajout, modification, suppression d'articles).
- **Interface** : Design responsive (CSS personnalisé + Bootstrap).

### Partie Administration
- **Dashboard** : Vue d'ensemble de l'activité.
- **Gestion des Produits** : 
  - Liste des produits existants.
  - Ajout, modification et suppression de produits.
  - Gestion des stocks.

## 🛠 Installation

1. **Base de données** :
   - Importez le fichier `database.sql` dans votre serveur MySQL (via phpMyAdmin ou ligne de commande).
   - Cela créera la base `script_ecommerce` et les tables nécessaires (`users`, `produits`, `stock`, `factures`, `commandes`).

2. **Configuration** :
   - Vérifiez les paramètres de connexion à la base de données dans `config/db.php`.

3. **Lancement** :
   - Placez le dossier du projet dans votre répertoire web (ex: `htdocs` pour XAMPP).
   - Accédez au site via `http://localhost/Script-Ecommerce/public/`.

## 📂 Structure du Projet

- `/admin` : Contrôleurs et vues de l'espace administration.
- `/assets` : Ressources statiques (CSS, JS, Images).
- `/config` : Configuration de la base de données.
- `/includes` : Fichiers réutilisables (header, footer, fonctions).
- `/public` : Pages accessibles aux visiteurs (index, login, panier).
- `/uploads` : Dossier de stockage des images produits.
- `database.sql` : Script de création de la base de données.

## 👤 Comptes par défaut

Un compte administrateur est créé par défaut lors de l'import SQL :
- **Email** : `admin@admin.admin`
- **Rôle** : `admin`
>>>>>>> beb253b5694bb8b2c53af1d82f04404720ec4594
