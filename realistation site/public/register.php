<?php
$pageTitle = 'Inscription - SlahPC';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = cleanInput($_POST['name'] ?? '');
    $email = cleanInput($_POST['email'] ?? '');
    $phone = cleanInput($_POST['phone'] ?? '');
    $address = cleanInput($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        flash('error', 'Nom, email et mot de passe sont obligatoires.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        flash('error', 'Email invalide.');
    } elseif (strlen($password) < 6) {
        flash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
    } elseif ($password !== $confirm) {
        flash('error', 'Les mots de passe ne correspondent pas.');
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, phone, address) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$name, $email, $hash, $phone, $address]);
            flash('success', 'Compte créé. Vous pouvez vous connecter.');
            redirect('login.php');
        } catch (PDOException $e) {
            flash('error', 'Cet email est déjà utilisé.');
        }
    }
}
?>
<section class="form-page container">
    <div class="form-card">
        <h1>Créer un compte</h1>
        <form method="POST" data-validate>
            <label>Nom complet<input type="text" name="name" required></label>
            <label>Email<input type="email" name="email" required></label>
            <label>Téléphone<input type="text" name="phone"></label>
            <label>Adresse<input type="text" name="address"></label>
            <label>Mot de passe<input type="password" name="password" required minlength="6"></label>
            <label>Confirmation<input type="password" name="confirm_password" required minlength="6"></label>
            <button class="btn btn-primary" type="submit">Créer un compte</button>
        </form>
        <p>Déjà inscrit ? <a href="login.php">Connexion</a></p>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
