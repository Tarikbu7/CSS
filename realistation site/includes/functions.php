<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function cleanInput($value) {
    return trim((string)$value);
}

function redirect($path) {
    header('Location: ' . $path);
    exit;
}

function flash($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function statusLabel($status) {
    $labels = [
        'Pending' => 'En attente',
        'Accepted' => 'Acceptée',
        'In_progress' => 'En cours',
        'Completed' => 'Terminée',
        'Cancelled' => 'Annulée'
    ];
    return $labels[$status] ?? $status;
}

function statusClass($status) {
    return 'status-' . strtolower(str_replace('_', '-', $status));
}
