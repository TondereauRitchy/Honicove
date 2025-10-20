<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie que l'image est bien envoyée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/';
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $imageName;

        // Déplace l'image vers le dossier uploads/
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            echo json_encode(['error' => true, 'message' => 'Échec du téléchargement de l’image.']);
            exit;
        }

        // Ajoute automatiquement le chemin de l'image aux données POST
        $_POST['image_path'] = $uploadPath;

        // Envoie toutes les données reçues (POST) à l'API
        $apiUrl = 'http://localhost/dashboard/vetiverV2/api/produits';

        $curl = curl_init($apiUrl);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($_POST)
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($httpCode !== 200 || !isset($result['data'])) {
            echo json_encode(['error' => true, 'message' => $result['message'] ?? 'Erreur API']);
        } else {
            echo json_encode(['error' => false, 'message' => 'Produit enregistré avec succès']);
        }
    } else {
        echo json_encode(['error' => true, 'message' => 'Image manquante ou invalide']);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Méthode non autorisée']);
}
