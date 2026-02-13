<?php
session_start();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if (isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
    }
}

header('Location: panier.php');
exit;
