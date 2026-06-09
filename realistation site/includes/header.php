<?php
require_once __DIR__ . '/auth.php';
$flashMessage = getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'SlahPC') ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="site-header">
    <nav class="navbar container">
        <a class="logo" href="../public/index.php">Slah<span>PC</span></a>
        <button class="menu-toggle" data-menu-toggle>☰</button>
        <div class="nav-links" data-nav-links>
            <a href="../public/index.php">Accueil</a>
            <a href="../public/services.php">Services</a>
            <a href="../public/contact.php">Contact</a>
            <?php if (isLoggedIn()): ?>
                <a href="../public/request-create.php">Demande</a>
                <a href="../public/my-requests.php">Mes demandes</a>
                <?php if (isAdmin()): ?>
                    <a href="../admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a class="btn btn-outline" href="../public/logout.php">Déconnexion</a>
            <?php else: ?>
                <a href="../public/login.php">Connexion</a>
                <a class="btn btn-primary" href="../public/register.php">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main>
<?php if ($flashMessage): ?>
    <div class="container alert alert-<?= e($flashMessage['type']) ?>" data-alert>
        <?= e($flashMessage['message']) ?>
        <button type="button" data-close-alert>×</button>
    </div>
<?php endif; ?>
