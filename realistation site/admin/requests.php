<?php
$pageTitle = 'Demandes Admin - SlahPC';
require_once '../includes/admin-header.php';
$status = $_GET['status'] ?? '';
$sql = 'SELECT rr.*, s.name AS service_name, u.name AS client_name FROM repair_requests rr JOIN services s ON s.id = rr.service_id JOIN users u ON u.id = rr.user_id';
$params = [];
if ($status !== '') {
    $sql .= ' WHERE rr.status = ?';
    $params[] = $status;
}
$sql .= ' ORDER BY rr.created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$requests = $stmt->fetchAll();
$statuses = ['Pending','Accepted','In_progress','Completed','Cancelled'];
?>
<div class="inline-head"><h1>Toutes les demandes</h1><a class="btn btn-outline" href="dashboard.php">Dashboard</a></div>
<form method="GET" class="filter-form">
    <label>Filtrer par statut
        <select name="status" onchange="this.form.submit()">
            <option value="">Tous</option>
            <?php foreach ($statuses as $st): ?>
                <option value="<?= e($st) ?>" <?= $status === $st ? 'selected' : '' ?>><?= e(statusLabel($st)) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
</form>
<div class="table-wrap">
<table>
<thead><tr><th>ID</th><th>Client</th><th>Service</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead>
<tbody>
<?php foreach ($requests as $request): ?>
<tr>
    <td>#<?= e($request['id']) ?></td>
    <td><?= e($request['client_name']) ?></td>
    <td><?= e($request['service_name']) ?></td>
    <td><?= e($request['created_at']) ?></td>
    <td><span class="badge <?= e(statusClass($request['status'])) ?>"><?= e(statusLabel($request['status'])) ?></span></td>
    <td><a class="btn btn-small" href="request-edit.php?id=<?= e($request['id']) ?>">Modifier</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
