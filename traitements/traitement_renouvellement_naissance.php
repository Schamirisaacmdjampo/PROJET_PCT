<?php
session_start();
require_once(__DIR__ . '/../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_extrait = !empty($_POST['numero_extrait']) ? $_POST['numero_extrait'] : null;
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $motif = $_POST['motif'];
    $nombre_copies = (int)$_POST['nombre_copies'];

    try {
        $stmt = $pdo->prepare("
            INSERT INTO renouvellements_naissance (
                nom, prenom, numero_extrait, date_naissance, lieu_naissance, motif, nombre_copies
            ) VALUES (
                :nom, :prenom, :numero_extrait, :date_naissance, :lieu_naissance, :motif, :nombre_copies
            )
        ");

        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':numero_extrait' => $numero_extrait,
            ':date_naissance' => $date_naissance,
            ':lieu_naissance' => $lieu_naissance,
            ':motif' => $motif,
            ':nombre_copies' => $nombre_copies
        ]);

        // Redirection vers page de paiement ou confirmation
        header("Location: ../paiement.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }

} else {
    echo "Méthode non autorisée.";
}
