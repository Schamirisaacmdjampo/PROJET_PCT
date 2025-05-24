<?php
session_start();
require_once('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $table = $_POST['table'] ?? null;
    $statut = $_POST['statut'] ?? null;
    $motif_refus = trim($_POST['motif_refus'] ?? '');

    // Validation basique
    if (!$id || !$table || !$statut) {
        $_SESSION['error'] = "Données manquantes.";
        header('Location: validation.php');
        exit;
    }

    // Si refusé, motif obligatoire
    if ($statut === 'refusé' && empty($motif_refus)) {
        $_SESSION['error'] = "Veuillez indiquer un motif pour le refus.";
        header('Location: validation.php');
        exit;
    }

    try {
        // Message automatique pour la validation
        $message_validation = '';
        if ($statut === 'validé') {
            $message_validation = "Votre demande a été acceptée et est en cours de traitement.";
            // Le motif refus reste vide même si envoyé par erreur
            $motif_refus = '';
        }

        $sql = "UPDATE `$table` SET statut = :statut, motif_refus = :motif_refus, message_validation = :message_validation, date_validation = NOW() WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':statut' => $statut,
            ':motif_refus' => $motif_refus,
            ':message_validation' => $message_validation,
            ':id' => $id
        ]);

        if ($statut === 'validé') {
            $_SESSION['success'] = "Demande validée avec succès.";
        } else {
            $_SESSION['success'] = "Demande refusée avec succès.";
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de la mise à jour : " . $e->getMessage();
    }

    header('Location: validation.php');
    exit;
} else {
    // Accès direct interdit
    header('Location: validation.php');
    exit;
}
