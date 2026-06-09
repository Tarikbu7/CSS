<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

function requireLogin() {
    if (!isLoggedIn()) {
        flash('error', 'Connectez-vous d’abord.');
        redirect('../public/login.php');
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        flash('error', 'Accès réservé à l’administrateur.');
        redirect('../public/login.php');
    }
}

function currentUser() {
    global $pdo;
    if (!isLoggedIn()) {
        return null;
    }
    $stmt = $pdo->prepare('SELECT id, name, email, role, phone, address FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
