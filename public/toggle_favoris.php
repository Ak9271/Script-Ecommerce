<?php
session_start();
require_once '../config/db.php';
require_once '../includes/fonctions.php';

if (!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = (int) $_GET['id'];
$userId = $_SESSION['user_id'];

toggleFavori($pdo, $userId, $id);

if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: detail_produit.php?id=$id");
}
exit;
