<?php
session_start();
require_once(__DIR__ . '/../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $nom_epoux = $_POST['nom_epoux'];
    $prenom_epoux = $_POST['prenom_epoux'];
    $nom_epouse = $_POST['nom_epouse'];
    $prenom_epouse = $_POST['prenom_epouse'];
    $date_mariage = $_POST['date_mariage'];
    $lieu_mariage = $_POST['lieu_mariage'];
    $temoin1 = $_POST['temoin1'];
    $temoin2 = $_POST['temoin2'];

    // Dossier upload
    $dossier_upload = __DIR__ . '/../uploads/';
    if (!is_dir($dossier_upload)) {
        mkdir($dossier_upload, 0777, true);
    }

    // Traitement des fichiers CNI
    $cni_epoux_path = null;
    $cni_epouse_path = null;

    if (isset($_FILES['cni_epoux']) && $_FILES['cni_epoux']['error'] === UPLOAD_ERR_OK) {
        $nom_fichier_epoux = uniqid() . '_cni_epoux.pdf';
        $cni_epoux_path = $dossier_upload . $nom_fichier_epoux;
        move_uploaded_file($_FILES['cni_epoux']['tmp_name'], $cni_epoux_path);
    }

    if (isset($_FILES['cni_epouse']) && $_FILES['cni_epouse']['error'] === UPLOAD_ERR_OK) {
        $nom_fichier_epouse = uniqid() . '_cni_epouse.pdf';
        $cni_epouse_path = $dossier_upload . $nom_fichier_epouse;
        move_uploaded_file($_FILES['cni_epouse']['tmp_name'], $cni_epouse_path);
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO mariage (
                nom_epoux, prenom_epoux, nom_epouse, prenom_epouse,
                date_mariage, lieu_mariage, temoin1, temoin2,
                cni_epoux_path, cni_epouse_path
            ) VALUES (
                :nom_epoux, :prenom_epoux, :nom_epouse, :prenom_epouse,
                :date_mariage, :lieu_mariage, :temoin1, :temoin2,
                :cni_epoux_path, :cni_epouse_path
            )
        ");

        $stmt->execute([
            ':nom_epoux' => $nom_epoux,
            ':prenom_epoux' => $prenom_epoux,
            ':nom_epouse' => $nom_epouse,
            ':prenom_epouse' => $prenom_epouse,
            ':date_mariage' => $date_mariage,
            ':lieu_mariage' => $lieu_mariage,
            ':temoin1' => $temoin1,
            ':temoin2' => $temoin2,
            ':cni_epoux_path' => $nom_fichier_epoux ?? null,
            ':cni_epouse_path' => $nom_fichier_epouse ?? null
        ]);

        header("Location: ../paiement.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }

} else {
    echo "Méthode non autorisée.";
}
