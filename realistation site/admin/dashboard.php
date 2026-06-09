<?php
$pageTitle = 'Dashboard Admin - SlahPC';
require_once '../includes/admin-header.php';
$stats = [
    'total' => $pdo->query('SELECT COUNT(*) FROM repair_requests')->fetchColumn(),
    'pending' => $pdo->query("SELECT COUNT(*) FROM repair_requests WHERE status = 'Pending'")->fetchColumn(),
    'progress' => $pdo->query("SELECT COUNT(*) FROM repair_requests WHERE status = 'In_progress'")->fetchColumn(),
    'completed' => $pdo->query("SELECT COUNT(*) FROM repair_requests WHERE status = 'Completed'")->fetchColumn(),
];
$latest = $pdo->query('SELECT rr.*, s.name AS service_name, u.name AS client_name FROM repair_requests rr JOIN services s ON s.id = rr.service_id JOIN users u ON u.id = rr.user_id ORDER BY rr.created_at DESC LIMIT 8')->fetchAll();
?>
<h1>Dashboard Admin</h1>
<div class="stats-grid">
    <div class="stat-card"><span>Total demandes</span><strong><?= e($stats['total']) ?></strong></div>
    <div class="stat-card"><span>En attente</span><strong><?= e($stats['pending']) ?></strong></div>
    <div class="stat-card"><span>En cours</span><strong><?= e($stats['progress']) ?></strong></div>
    <div class="stat-card"><span>Terminées</span><strong><?= e($stats['completed']) ?></strong></div>
</div>
<h2>Dernières demandes</h2>
<div class="table-wrap">
<table>
<thead><tr><th>ID</th><th>Client</th><th>Service</th><th>Statut</th><th>Action</th></tr></thead>
<tbody>
<?php foreach ($latest as $item): ?>
<tr>
    <td>#<?= e($item['id']) ?></td>
    <td><?= e($item['client_name']) ?></td>
    <td><?= e($item['service_name']) ?></td>
    <td><span class="badge <?= e(statusClass($item['status'])) ?>"><?= e(statusLabel($item['status'])) ?></span></td>
    <td><a class="btn btn-small" href="request-edit.php?id=<?= e($item['id']) ?>">Modifier</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
