<?php
$pageTitle = 'Nouvelle demande - SlahPC';
require_once '../includes/header.php';
requireLogin();

$selectedService = (int)($_GET['service_id'] ?? 0);
$services = $pdo->query('SELECT * FROM services WHERE active = 1 ORDER BY name')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = (int)($_POST['service_id'] ?? 0);
    $brand = cleanInput($_POST['device_brand'] ?? '');
    $model = cleanInput($_POST['device_model'] ?? '');
    $problem = cleanInput($_POST['problem_description'] ?? '');
    $address = cleanInput($_POST['address'] ?? '');
    $phone = cleanInput($_POST['phone'] ?? '');

    if ($serviceId <= 0 || $problem === '' || $phone === '') {
        flash('error', 'Service, problème et téléphone sont obligatoires.');
    } else {
        $stmt = $pdo->prepare('INSERT INTO repair_requests (user_id, service_id, device_brand, device_model, problem_description, address, phone) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], $serviceId, $brand, $model, $problem, $address, $phone]);
        flash('success', 'Demande envoyée avec succès.');
        redirect('my-requests.php');
    }
}
?>
<section class="form-page container">
    <div class="form-card wide">
        <h1>Nouvelle demande de réparation</h1>
        <form method="POST" data-validate>
            <label>Service
                <select name="service_id" required>
                    <option value="">Choisir un service</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= e($service['id']) ?>" <?= $selectedService === (int)$service['id'] ? 'selected' : '' ?>><?= e($service['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <div class="two-cols">
                <label>Marque PC<input type="text" name="device_brand" placeholder="HP, Dell, Asus..."></label>
                <label>Modèle PC<input type="text" name="device_model" placeholder="Latitude, VivoBook..."></label>
            </div>
            <label>Problème<textarea name="problem_description" rows="5" required></textarea></label>
            <div class="two-cols">
                <label>Adresse<input type="text" name="address"></label>
                <label>Téléphone<input type="text" name="phone" required></label>
            </div>
            <button class="btn btn-primary" type="submit">Envoyer la demande</button>
        </form>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
