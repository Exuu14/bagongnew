<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['id'])) {
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['id'],
            'username' => $_SESSION['username']
        ]
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>