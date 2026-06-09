<?php
$pageTitle = 'Détails demande - SlahPC';
require_once '../includes/header.php';
requireLogin();

$id = (int)($_GET['id'] ?? 0);
$sql = 'SELECT rr.*, s.name AS service_name, u.name AS client_name, u.email AS client_email FROM repair_requests rr JOIN services s ON s.id = rr.service_id JOIN users u ON u.id = rr.user_id WHERE rr.id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$request = $stmt->fetch();

if (!$request || (!isAdmin() && (int)$request['user_id'] !== (int)$_SESSION['user_id'])) {
    flash('error', 'Demande introuvable.');
    redirect('my-requests.php');
}
?>
<section class="container page-section">
    <article class="details-card">
        <div class="inline-head">
            <div><p class="eyebrow">Demande #<?= e($request['id']) ?></p><h1><?= e($request['service_name']) ?></h1></div>
            <span class="badge <?= e(statusClass($request['status'])) ?>"><?= e(statusLabel($request['status'])) ?></span>
        </div>
        <div class="details-grid">
            <p><strong>Client:</strong> <?= e($request['client_name']) ?> (<?= e($request['client_email']) ?>)</p>
            <p><strong>PC:</strong> <?= e($request['device_brand']) ?> <?= e($request['device_model']) ?></p>
            <p><strong>Téléphone:</strong> <?= e($request['phone']) ?></p>
            <p><strong>Adresse:</strong> <?= e($request['address']) ?></p>
            <p><strong>Prix estimé:</strong> <?= $request['estimated_price'] ? e($request['estimated_price']) . ' MAD' : 'Pas encore défini' ?></p>
            <p><strong>Date:</strong> <?= e($request['created_at']) ?></p>
        </div>
        <h3>Problème</h3>
        <p><?= nl2br(e($request['problem_description'])) ?></p>
        <?php if ($request['admin_note']): ?>
            <h3>Note admin</h3>
            <p><?= nl2br(e($request['admin_note'])) ?></p>
        <?php endif; ?>
        <?php if (isAdmin()): ?>
            <a class="btn btn-primary" href="../admin/request-edit.php?id=<?= e($request['id']) ?>">Modifier par admin</a>
        <?php endif; ?>
    </article>
</section>
<?php require_once '../includes/footer.php'; ?>
