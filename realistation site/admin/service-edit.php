<?php
$pageTitle = 'Modifier service - SlahPC';
require_once '../includes/admin-header.php';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = cleanInput($_POST['name'] ?? '');
    $description = cleanInput($_POST['description'] ?? '');
    $price = (float)($_POST['base_price'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    $stmt = $pdo->prepare('UPDATE services SET name = ?, description = ?, base_price = ?, active = ? WHERE id = ?');
    $stmt->execute([$name, $description, $price, $active, $id]);
    flash('success', 'Service modifié.');
    redirect('services.php');
}
$stmt = $pdo->prepare('SELECT * FROM services WHERE id = ?');
$stmt->execute([$id]);
$service = $stmt->fetch();
if (!$service) {
    flash('error', 'Service introuvable.');
    redirect('services.php');
}
?>
<h1>Modifier service</h1>
<div class="admin-form-card">
<form method="POST">
    <input type="hidden" name="id" value="<?= e($service['id']) ?>">
    <label>Nom<input type="text" name="name" value="<?= e($service['name']) ?>" required></label>
    <label>Description<textarea name="description" rows="5"><?= e($service['description']) ?></textarea></label>
    <label>Prix de base<input type="number" step="0.01" name="base_price" value="<?= e($service['base_price']) ?>"></label>
    <label class="checkbox"><input type="checkbox" name="active" <?= $service['active'] ? 'checked' : '' ?>> Actif</label>
    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
