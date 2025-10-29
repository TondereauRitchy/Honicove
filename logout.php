<?php
include 'includes/SessionManager.class.php';

header('Content-Type: application/json');

$sessionManager = SessionManager::getInstance();

// Détruire la session
$sessionManager->logout();

echo json_encode(['success' => true, 'message' => 'Déconnexion réussie']);
?>
