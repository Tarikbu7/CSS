<?php
$pageTitle = 'Services - SlahPC';
require_once '../includes/header.php';
$stmt = $pdo->query('SELECT * FROM services WHERE active = 1 ORDER BY id DESC');
$services = $stmt->fetchAll();
?>
<section class="page-header container">
    <p class="eyebrow">SlahPC</p>
    <h1>Nos services</h1>
    <p>Choisissez le service qui correspond à votre problème.</p>
</section>
<section class="container card-grid page-section">
    <?php foreach ($services as $service): ?>
        <article class="card service-card">
            <h3><?= e($service['name']) ?></h3>
            <p><?= e($service['description']) ?></p>
            <div class="card-footer">
                <strong><?= e($service['base_price']) ?> MAD</strong>
                <a class="btn btn-primary" href="request-create.php?service_id=<?= e($service['id']) ?>">Demander</a>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php require_once '../includes/footer.php'; ?>
