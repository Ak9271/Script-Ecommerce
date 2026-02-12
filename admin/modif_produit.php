<?php
session_start();
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}

$id = intval($_GET['id'] ?? 0);
$produit = getProduitById($pdo, $id);

if (!$produit) {
    header('Location: liste_produits.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $prix = floatval($_POST['prix'] ?? 0);
    $categorie = trim($_POST['categorie'] ?? 'General');
    $langage = trim($_POST['langage'] ?? 'PHP');
    $version = trim($_POST['version'] ?? '1.0');
    $quantite = intval($_POST['quantite'] ?? 0);

    if (empty($nom) || $prix <= 0) {
        $error = 'Le nom et un prix valide sont requis.';
    } else {
        $imageName = $produit['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed)) {
                if (!empty($produit['image']) && file_exists('../uploads/' . $produit['image'])) {
                    unlink('../uploads/' . $produit['image']);
                }
                $imageName = uniqid('script_') . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageName);
            }
        }

        $stmt = $pdo->prepare("UPDATE produits SET nom = :nom, description = :description, prix = :prix, image = :image, categorie = :categorie, langage = :langage, version = :version WHERE id_produit = :id");
        $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':prix' => $prix,
            ':image' => $imageName,
            ':categorie' => $categorie,
            ':langage' => $langage,
            ':version' => $version,
            ':id' => $id
        ]);

        $stmtCheck = $pdo->prepare("SELECT id FROM stock WHERE id_produit = :id");
        $stmtCheck->execute([':id' => $id]);
        if ($stmtCheck->fetch()) {
            $stmtStock = $pdo->prepare("UPDATE stock SET quantite = :qty WHERE id_produit = :id");
            $stmtStock->execute([':qty' => $quantite, ':id' => $id]);
        } else {
            $stmtStock = $pdo->prepare("INSERT INTO stock (id_produit, quantite) VALUES (:id, :qty)");
            $stmtStock->execute([':id' => $id, ':qty' => $quantite]);
        }

        header('Location: liste_produits.php?success=updated');
        exit;
    }
} else {
    $nom = $produit['nom'];
    $description = $produit['description'];
    $prix = $produit['prix'];
    $categorie = $produit['categorie'];
    $langage = $produit['langage'] ?? 'PHP';
    $version = $produit['version'] ?? '1.0';
    $quantite = $produit['quantite'] ?? 0;
}

$langages = ['PHP', 'Python', 'JavaScript', 'Bash', 'C#', 'Java', 'Ruby', 'Go', 'Rust', 'TypeScript'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier - Admin ScriptShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <i class="fas fa-code"></i>
                <span>ScriptShop</span>
            </div>
            <nav class="admin-nav">
                <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                <a href="liste_produits.php" class="active"><i class="fas fa-file-code"></i> Scripts</a>
                <a href="ajout_produits.php"><i class="fas fa-plus-circle"></i> Ajouter</a>
                <a href="liste_users.php"><i class="fas fa-users"></i> Utilisateurs</a>
            </nav>
            <div class="admin-sidebar-footer">
                <a href="../public/index.php"><i class="fas fa-arrow-left"></i> Retour au site</a>
                <a href="../public/logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Modifier :
                    <?= htmlspecialchars($produit['nom']) ?>
                </h1>
            </div>

            <?php if ($error): ?>
                <div class="auth-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="admin-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom du script</label>
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix (€)</label>
                        <input type="number" id="prix" name="prix" step="0.01" min="0"
                            value="<?= htmlspecialchars($prix) ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="langage">Langage</label>
                        <select id="langage" name="langage">
                            <?php foreach ($langages as $lang): ?>
                                <option value="<?= $lang ?>" <?= $langage === $lang ? 'selected' : '' ?>>
                                    <?= $lang ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="version">Version</label>
                        <input type="text" id="version" name="version" value="<?= htmlspecialchars($version) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <input type="text" id="categorie" name="categorie" value="<?= htmlspecialchars($categorie) ?>">
                    </div>
                    <div class="form-group">
                        <label for="quantite">Stock</label>
                        <input type="number" id="quantite" name="quantite" min="0"
                            value="<?= htmlspecialchars($quantite) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                        rows="5"><?= htmlspecialchars($description) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <?php if (!empty($produit['image'])): ?>
                        <div class="current-image">
                            <img src="../uploads/<?= htmlspecialchars($produit['image']) ?>" alt="">
                            <span>Image actuelle</span>
                        </div>
                    <?php endif; ?>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-shop btn-shop-primary"><i class="fas fa-save"></i>
                        Enregistrer</button>
                    <a href="liste_produits.php" class="btn-shop btn-shop-outline">Annuler</a>
                </div>
            </form>
        </main>
    </div>

</body>

</html>