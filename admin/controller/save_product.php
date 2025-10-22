<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../../uploads/';

    $imagesData = [];

    // Gérer les images multiples avec couleurs
    if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $imageName = uniqid() . '_' . basename($name);
                $uploadPath = $uploadDir . $imageName;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $uploadPath)) {
                    $color = isset($_POST['colors'][$key]) ? $_POST['colors'][$key] : '';
                    $imagesData[] = [
                        'path' => $imageName,
                        'color' => $color
                    ];
                }
            }
        }
    }

    // Pour compatibilité, gérer les anciens champs image, image2, image3 si présents
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $color = isset($_POST['color']) ? $_POST['color'] : '';
            $imagesData[] = [
                'path' => $imageName,
                'color' => $color
            ];
        }
    }

    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === UPLOAD_ERR_OK) {
        $image2Name = uniqid() . '_' . basename($_FILES['image2']['name']);
        $uploadPath2 = $uploadDir . $image2Name;
        if (move_uploaded_file($_FILES['image2']['tmp_name'], $uploadPath2)) {
            $imagesData[] = [
                'path' => $image2Name,
                'color' => ''
            ];
        }
    }

    if (isset($_FILES['image3']) && $_FILES['image3']['error'] === UPLOAD_ERR_OK) {
        $image3Name = uniqid() . '_' . basename($_FILES['image3']['name']);
        $uploadPath3 = $uploadDir . $image3Name;
        if (move_uploaded_file($_FILES['image3']['tmp_name'], $uploadPath3)) {
            $imagesData[] = [
                'path' => $image3Name,
                'color' => ''
            ];
        }
    }

    // Préparer les données pour l'API
    $data = $_POST;
    $data['images'] = $imagesData;

    // Déterminer si c'est un ajout ou une modification
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Modification
        $method = 'PUT';
        $apiUrl = 'http://localhost/dashboard/Honicove-1/api/products/' . $_POST['id'];
    } else {
        // Ajout
        $method = 'POST';
        $apiUrl = 'http://localhost/dashboard/Honicove-1/api/products';
        // Pour l'ajout, vérifier qu'au moins une image est présente
        if (empty($imagesData)) {
            echo json_encode(['error' => true, 'message' => 'Au moins une image est requise pour l\'ajout']);
            exit;
        }
    }

    // Envoie les données à l'API
    $curl = curl_init($apiUrl);
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    $result = json_decode($response, true);

    if ($httpCode >= 200 && $httpCode < 300 && isset($result['error']) && !$result['error']) {
        echo json_encode(['error' => false, 'message' => 'Produit traité avec succès']);
    } else {
        echo json_encode(['error' => true, 'message' => $result['issues'] ?? $response]);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Méthode non autorisée']);
}
