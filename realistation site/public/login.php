<?php
$pageTitle = 'Connexion - SlahPC';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = cleanInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        flash('success', 'Bienvenue ' . $user['name']);
        redirect($user['role'] === 'admin' ? '../admin/dashboard.php' : 'my-requests.php');
    } else {
        flash('error', 'Email ou mot de passe incorrect.');
    }
}
?>
<section class="form-page container">
    <div class="form-card">
        <h1>Connexion</h1>
        <form method="POST" data-validate>
            <label>Email<input type="email" name="email" required></label>
            <label>Mot de passe<input type="password" name="password" required></label>
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
        <p>Pas de compte ? <a href="register.php">Inscription</a></p>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
