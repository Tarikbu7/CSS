<?php
$pageTitle = 'Ajouter service - SlahPC';
require_once '../includes/admin-header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = cleanInput($_POST['name'] ?? '');
    $description = cleanInput($_POST['description'] ?? '');
    $price = (float)($_POST['base_price'] ?? 0);
    $active = isset($_POST['active']) ? 1 : 0;
    if ($name === '') {
        flash('error', 'Le nom est obligatoire.');
    } else {
        $stmt = $pdo->prepare('INSERT INTO services (name, description, base_price, active) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $description, $price, $active]);
        flash('success', 'Service ajouté.');
        redirect('services.php');
    }
}
?>
<h1>Ajouter service</h1>
<div class="admin-form-card">
<form method="POST">
    <label>Nom<input type="text" name="name" required></label>
    <label>Description<textarea name="description" rows="5"></textarea></label>
    <label>Prix de base<input type="number" step="0.01" name="base_price"></label>
    <label class="checkbox"><input type="checkbox" name="active" checked> Actif</label>
    <button class="btn btn-primary" type="submit">Ajouter</button>
</form>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
