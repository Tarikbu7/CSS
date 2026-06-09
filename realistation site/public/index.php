<?php
$pageTitle = 'Accueil - SlahPC';
require_once '../includes/header.php';
$stmt = $pdo->query('SELECT * FROM services WHERE active = 1 ORDER BY id LIMIT 4');
$services = $stmt->fetchAll();
?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Réparation informatique au Maroc</p>
            <h1>Réparez votre PC sans vous déplacer</h1>
            <p>SlahPC vous aide pour les problèmes hardware, software, virus, malware et sauvegarde de données.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="request-create.php">Demander une réparation</a>
                <a class="btn btn-outline" href="services.php">Voir les services</a>
            </div>
        </div>
        <div class="hero-card">
            <div class="computer-icon">💻</div>
            <h3>Diagnostic rapide</h3>
            <p>Expliquez le problème, suivez le statut, et recevez une estimation claire.</p>
        </div>
    </div>
</section>

<section class="section container">
    <div class="section-head">
        <p class="eyebrow">Services</p>
        <h2>Nos services principaux</h2>
    </div>
    <div class="card-grid">
        <?php foreach ($services as $service): ?>
            <article class="card">
                <h3><?= e($service['name']) ?></h3>
                <p><?= e($service['description']) ?></p>
                <strong><?= e($service['base_price']) ?> MAD</strong>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-head">
            <p class="eyebrow">Processus</p>
            <h2>Comment ça marche ?</h2>
        </div>
        <div class="steps">
            <div><span>1</span><h3>Envoyer une demande</h3><p>Choisissez le service et décrivez le problème.</p></div>
            <div><span>2</span><h3>Diagnostic</h3><p>L’admin analyse la demande et donne une estimation.</p></div>
            <div><span>3</span><h3>Réparation</h3><p>Le statut passe en cours pendant le travail.</p></div>
            <div><span>4</span><h3>Terminé</h3><p>Le client suit la fin de la réparation en ligne.</p></div>
        </div>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
