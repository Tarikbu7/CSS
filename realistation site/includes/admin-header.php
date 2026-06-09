<?php
require_once __DIR__ . '/auth.php';
requireAdmin();
$flashMessage = getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin SlahPC') ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <a class="logo" href="dashboard.php">Slah<span>PC</span></a>
        <a href="dashboard.php">Dashboard</a>
        <a href="requests.php">Demandes</a>
        <a href="services.php">Services</a>
        <a href="users.php">Utilisateurs</a>
        <a href="messages.php">Messages</a>
        <a href="../public/index.php">Voir le site</a>
        <a href="../public/logout.php">Déconnexion</a>
    </aside>
    <section class="admin-content">
        <?php if ($flashMessage): ?>
            <div class="alert alert-<?= e($flashMessage['type']) ?>" data-alert>
                <?= e($flashMessage['message']) ?>
                <button type="button" data-close-alert>×</button>
            </div>
        <?php endif; ?>
