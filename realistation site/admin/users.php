<?php
$pageTitle = 'Utilisateurs - SlahPC';
require_once '../includes/admin-header.php';
$users = $pdo->query('SELECT id, name, email, role, phone, address, created_at FROM users ORDER BY created_at DESC')->fetchAll();
?>
<h1>Utilisateurs</h1>
<div class="table-wrap">
<table>
<thead><tr><th>ID</th><th>Nom</th><th>Email</th><th>Role</th><th>Téléphone</th><th>Date</th></tr></thead>
<tbody>
<?php foreach ($users as $user): ?>
<tr>
    <td>#<?= e($user['id']) ?></td>
    <td><?= e($user['name']) ?></td>
    <td><?= e($user['email']) ?></td>
    <td><?= e($user['role']) ?></td>
    <td><?= e($user['phone']) ?></td>
    <td><?= e($user['created_at']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
