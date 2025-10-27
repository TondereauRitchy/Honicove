<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bg_image'])) {
    $file = $_FILES['bg_image'];

    // Check for errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'Erreur lors du téléchargement du fichier.']);
        exit();
    }

    // Validate file type (only images)
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        echo json_encode(['error' => 'Type de fichier non autorisé. Seules les images sont acceptées.']);
        exit();
    }

    // Validate file size (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        echo json_encode(['error' => 'Le fichier est trop volumineux. Taille maximale : 5MB.']);
        exit();
    }

    // Move the uploaded file to replace logo/main.jpg
    $target_path = '../logo/main.jpg';
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        echo json_encode(['success' => 'Image de fond mise à jour avec succès.']);
    } else {
        echo json_encode(['error' => 'Erreur lors de la sauvegarde du fichier.']);
    }
} else {
    echo json_encode(['error' => 'Requête invalide.']);
}
?>
