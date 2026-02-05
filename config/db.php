<?php

$host = 'localhost';
$nom_db = 'script_ecommerce';
$username = 'root'; //par defaut dans xampp
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nom_db;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage() . "<br>Please check config/db.php and ensure database '$nom_db' exists.");
}
?>