<?php
include 'includes/SessionManager.class.php';

header('Content-Type: application/json');

// Récupérer les données JSON envoyées
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Données invalides']);
    exit;
}

$sessionManager = SessionManager::getInstance();

// Stocker les informations utilisateur dans la session
$sessionManager->setUser($data);

// Retourner une réponse de succès
echo json_encode(['success' => true, 'message' => 'Session créée avec succès']);
?>
