<?php
include 'includes/SessionManager.class.php';

header('Content-Type: application/json');

$sessionManager = SessionManager::getInstance();

// Vérifier si l'utilisateur est connecté
$loggedIn = $sessionManager->isLoggedIn();

if ($loggedIn) {
    // Vérifier l'intégrité de la session
    $validSession = $sessionManager->validateSession();
    if ($validSession) {
        echo json_encode([
            'logged_in' => true,
            'user' => $sessionManager->getUser(),
            'user_id' => $sessionManager->getUserId()
        ]);
    } else {
        echo json_encode(['logged_in' => false]);
    }
} else {
    echo json_encode(['logged_in' => false]);
}
?>
