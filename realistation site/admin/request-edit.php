<?php
$pageTitle = 'Modifier demande - SlahPC';
require_once '../includes/admin-header.php';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$statuses = ['Pending','Accepted','In_progress','Completed','Cancelled'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? 'Pending';
    $estimatedPrice = $_POST['estimated_price'] !== '' ? (float)$_POST['estimated_price'] : null;
    $adminNote = cleanInput($_POST['admin_note'] ?? '');

    if (!in_array($status, $statuses, true)) {
        flash('error', 'Statut invalide.');
    } else {
        $stmt = $pdo->prepare('UPDATE repair_requests SET status = ?, estimated_price = ?, admin_note = ? WHERE id = ?');
        $stmt->execute([$status, $estimatedPrice, $adminNote, $id]);
        flash('success', 'Demande mise à jour.');
        redirect('requests.php');
    }
}

$stmt = $pdo->prepare('SELECT rr.*, s.name AS service_name, u.name AS client_name FROM repair_requests rr JOIN services s ON s.id = rr.service_id JOIN users u ON u.id = rr.user_id WHERE rr.id = ?');
$stmt->execute([$id]);
$request = $stmt->fetch();
if (!$request) {
    flash('error', 'Demande introuvable.');
    redirect('requests.php');
}
?>
<h1>Modifier la demande #<?= e($request['id']) ?></h1>
<div class="admin-form-card">
    <p><strong>Client:</strong> <?= e($request['client_name']) ?></p>
    <p><strong>Service:</strong> <?= e($request['service_name']) ?></p>
    <p><strong>Problème:</strong> <?= nl2br(e($request['problem_description'])) ?></p>
    <form method="POST">
        <input type="hidden" name="id" value="<?= e($request['id']) ?>">
        <label>Statut
            <select name="status">
                <?php foreach ($statuses as $st): ?>
                    <option value="<?= e($st) ?>" <?= $request['status'] === $st ? 'selected' : '' ?>><?= e(statusLabel($st)) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Prix estimé MAD<input type="number" step="0.01" name="estimated_price" value="<?= e($request['estimated_price']) ?>"></label>
        <label>Note admin<textarea name="admin_note" rows="5"><?= e($request['admin_note']) ?></textarea></label>
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </form>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
