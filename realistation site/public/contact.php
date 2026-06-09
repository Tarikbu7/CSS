<?php
$pageTitle = 'Contact - SlahPC';
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = cleanInput($_POST['name'] ?? '');
    $email = cleanInput($_POST['email'] ?? '');
    $subject = cleanInput($_POST['subject'] ?? '');
    $message = cleanInput($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        flash('error', 'Nom, email et message sont obligatoires.');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        flash('error', 'Email invalide.');
    } else {
        $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $subject, $message]);
        flash('success', 'Message envoyé avec succès.');
        redirect('contact.php');
    }
}
?>
<section class="form-page container">
    <div class="form-card">
        <h1>Contactez-nous</h1>
        <form method="POST" data-validate>
            <label>Nom<input type="text" name="name" required></label>
            <label>Email<input type="email" name="email" required></label>
            <label>Sujet<input type="text" name="subject"></label>
            <label>Message<textarea name="message" rows="5" required></textarea></label>
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
    </div>
</section>
<?php require_once '../includes/footer.php'; ?>
