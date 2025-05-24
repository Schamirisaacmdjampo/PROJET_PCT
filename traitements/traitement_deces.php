<?php
session_start();
require_once(__DIR__ . '/../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_deces = $_POST['date_deces'];
    $date_naissance = $_POST['date_naissance'];
    $cause_deces = $_POST['cause_deces'];
    $lieu_deces = $_POST['lieu_deces'];
    $nombre_copies = (int)$_POST['nombre_copies'];

    // Traitement du fichier justificatif (facultatif pour le moment)
    $justificatif_path = null;
    $dossier_upload = __DIR__ . '/../uploads/';
    if (!is_dir($dossier_upload)) {
        mkdir($dossier_upload, 0777, true);
    }

    if (isset($_FILES['justificatif']) && $_FILES['justificatif']['error'] === UPLOAD_ERR_OK) {
        $nom_fichier = uniqid() . '_justificatif.pdf';
        $justificatif_path = $dossier_upload . $nom_fichier;
        move_uploaded_file($_FILES['justificatif']['tmp_name'], $justificatif_path);
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO deces (nom, prenom, date_deces, date_naissance, cause_deces, lieu_deces, justificatif_path, nombre_copies)
            VALUES (:nom, :prenom, :date_deces, :date_naissance, :cause_deces, :lieu_deces, :justificatif_path, :nombre_copies)
        ");

        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_deces' => $date_deces,
            ':date_naissance' => $date_naissance,
            ':lieu_deces' => $lieu_deces,
            ':cause_deces' => $cause_deces,
            ':justificatif_path' => $nom_fichier ?? null,
            ':nombre_copies' => $nombre_copies
        ]);

        // Redirection vers la page de paiement
        header("Location: ../paiement.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }

} else {
    echo "Méthode non autorisée.";
}
