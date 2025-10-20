<?php
session_start();

// 1. Récupère les données envoyées en JSON depuis le frontend (via fetch)
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['error' => true, 'message' => 'Champs requis']);
    exit;
}

$apiUrl = 'http://localhost/dashboard/honicove/api/public/index.php?route=users/login'; // adapte le chemin si besoin

$curl = curl_init($apiUrl);

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($curl);

// echo($response);

// 3. Traite la réponse de l’API
$result = json_decode($response, true);

$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($http_code !== 200 || !isset($result['error']) || $result['error']) {
    echo json_encode([
        'error' => true,
        'issues' => $result['issues'] ?? $response
    ]);
    exit;
} else {
    // 4. Si succès → crée une session
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['id_admin'] = $result['data']['id'];
    $_SESSION['email_admin'] = $result['data']['email'];

    echo json_encode([
        'error' => false,
        'message' => 'Connexion réussie'
    ]);

}