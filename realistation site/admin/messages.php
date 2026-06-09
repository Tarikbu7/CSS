<?php
$pageTitle = 'Messages - SlahPC';
require_once '../includes/admin-header.php';
$messages = $pdo->query('SELECT * FROM contact_messages ORDER BY created_at DESC')->fetchAll();
?>
<h1>Messages contact</h1>
<div class="message-list">
<?php foreach ($messages as $message): ?>
    <article class="message-card">
        <div class="inline-head"><h3><?= e($message['subject'] ?: 'Sans sujet') ?></h3><span><?= e($message['created_at']) ?></span></div>
        <p><strong><?= e($message['name']) ?></strong> — <?= e($message['email']) ?></p>
        <p><?= nl2br(e($message['message'])) ?></p>
    </article>
<?php endforeach; ?>
<?php if (!$messages): ?><p>Aucun message.</p><?php endif; ?>
</div>
<?php require_once '../includes/admin-footer.php'; ?>
