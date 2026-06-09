<?php
$pageTitle = 'Mes demandes - SlahPC';
require_once '../includes/header.php';
requireLogin();

$stmt = $pdo->prepare('SELECT rr.*, s.name AS service_name FROM repair_requests rr JOIN services s ON s.id = rr.service_id WHERE rr.user_id = ? ORDER BY rr.created_at DESC');
$stmt->execute([$_SESSION['user_id']]);
$requests = $stmt->fetchAll();
?>
<section class="container page-section">
    <div class="section-head inline-head">
        <div><p class="eyebrow">Client</p><h1>Mes demandes</h1></div>
        <a class="btn btn-primary" href="request-create.php">Nouvelle demande</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>ID</th><th>Service</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <td>#<?= e($request['id']) ?></td>
                    <td><?= e($request['service_name']) ?></td>
                    <td><?= e($request['created_at']) ?></td>
                    <td><span class="badge <?= e(statusClass($request['status'])) ?>"><?= e(statusLabel($request['status'])) ?></span></td>
                    <td><a class="btn btn-small" href="request-details.php?id=<?= e($request['id']) ?>">Détails</a></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$requests): ?>
                <tr><td colspan="5">Aucune demande pour le moment.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
