<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM users ORDER BY cree_le DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - Admin ScriptShop</title>
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
                <a href="liste_produits.php"><i class="fas fa-file-code"></i> Scripts</a>
                <a href="ajout_produits.php"><i class="fas fa-plus-circle"></i> Ajouter</a>
                <a href="liste_users.php" class="active"><i class="fas fa-users"></i> Utilisateurs</a>
            </nav>
            <div class="admin-sidebar-footer">
                <a href="../public/index.php"><i class="fas fa-arrow-left"></i> Retour au site</a>
                <a href="../public/logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Gestion des Utilisateurs</h1>
            </div>

            <?php if (!empty($users)): ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Date d'inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($user['id_user']) ?>
                                    </td>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar-placeholder">
                                                <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                            </div>
                                            <?= htmlspecialchars($user['username']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($user['email']) ?>
                                    </td>
                                    <td>
                                        <?php if ($user['role'] === 'admin'): ?>
                                            <span class="badge badge-admin">Admin</span>
                                        <?php else: ?>
                                            <span class="badge badge-user">Utilisateur</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y H:i', strtotime($user['cree_le'])) ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <?php if ($user['id_user'] !== $_SESSION['user_id']): ?>
                                                <a href="#" class="btn-action btn-delete" title="Supprimer"
                                                    onclick="alert('Fonctionnalité à venir')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <p>Aucun utilisateur inscrit.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>

</body>

</html>