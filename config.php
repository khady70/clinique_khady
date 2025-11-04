<?php
// config.php
session_start();

$DB_HOST = '127.0.0.1';
$DB_NAME = 'clinique';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Erreur BDD: ' . $e->getMessage());
}

function is_logged() {
    return isset($_SESSION['user']);
}

function require_role($role) {
    if (!is_logged() || $_SESSION['user']['role'] !== $role) {
        header('Location: /clinique/login.php');
        exit;
    }
}
