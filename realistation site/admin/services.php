<?php
$pageTitle = 'Services Admin - SlahPC';
require_once '../includes/admin-header.php';
$services = $pdo->query('SELECT * FROM services ORDER BY id DESC')->fetchAll();
?>
<div class="inline-head"><h1>Services</h1><a class="btn btn-primary" href="service-create.php">Ajouter service</a></div>
<div class="table-wrap">
<table>
<thead><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Actif</th><th>Actions</th></tr></thead>
<tbody>
<?php foreach ($services as $service): ?>
<tr>
    <td>#<?= e($service['id']) ?></td>
    <td><?= e($service['name']) ?></td>
    <td><?= e($service['base_price']) ?> MAD</td>
    <td><?= $service['active'] ? 'Oui' : 'Non' ?></td>
    <td><a class="btn btn-small" href="service-edit.php?id=<?= e($service['id']) ?>">Modifier</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
