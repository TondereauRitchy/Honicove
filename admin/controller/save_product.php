<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../../uploads/';

    // Gérer image1 si présente
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $_POST['image_1'] = $imageName;
        }
    }

    // Gérer image2 si présente
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2Name = uniqid() . '_' . basename($_FILES['image2']['name']);
        $uploadPath2 = $uploadDir . $image2Name;
        if (move_uploaded_file($_FILES['image2']['tmp_name'], $uploadPath2)) {
            $_POST['image_2'] = $image2Name;
        }
    }

    // Gérer image3 si présente
    if (isset($_FILES['image3']) && $_FILES['image3']['error'] === UPLOAD_ERR_OK) {
        $image3Name = uniqid() . '_' . basename($_FILES['image3']['name']);
        $uploadPath3 = $uploadDir . $image3Name;
        if (move_uploaded_file($_FILES['image3']['tmp_name'], $uploadPath3)) {
            $_POST['image_3'] = $image3Name;
        }
    }

    // Déterminer si c'est un ajout ou une modification
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Modification
        $method = 'PUT';
        $apiUrl = 'http://localhost/dashboard/Honicove-1/api/products/' . $_POST['id'];
    } else {
        // Ajout
        $method = 'POST';
        $apiUrl = 'http://localhost/dashboard/Honicove-1/api/products';
        // Pour l'ajout, vérifier qu'au moins image_1 est présente
        if (!isset($_POST['image_1'])) {
            echo json_encode(['error' => true, 'message' => 'Image principale manquante pour l\'ajout']);
            exit;
        }
    }

    // Envoie les données à l'API
    $curl = curl_init($apiUrl);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($_POST)
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    $result = json_decode($response, true);

    if ($httpCode >= 200 && $httpCode < 300 && !isset($result['error'])) {
        echo json_encode(['error' => false, 'message' => 'Produit traité avec succès']);
    } else {
        echo json_encode(['error' => true, 'message' => $result['message'] ?? 'Erreur API']);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Méthode non autorisée']);
}
