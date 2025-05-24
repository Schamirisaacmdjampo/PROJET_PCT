<?php
session_start(); // Pour les messages flash
include('header_admin.php');
require_once('../includes/db.php');

// Gestion des messages de succès ou d'erreur
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

function afficherDemandes(PDO $pdo, string $table, string $titreSection, array $colonnes) {
    try {
        $stmt = $pdo->query("SELECT * FROM `$table` ORDER BY date_demande DESC");
        $demandes = $stmt->fetchAll();

        echo "<h2>$titreSection</h2>";

        if (empty($demandes)) {
            echo "<p>Aucune demande trouvée.</p>";
            return;
        }

        foreach ($demandes as $demande) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";

            foreach ($colonnes as $colonne => $label) {
                if (!empty($demande[$colonne])) {
                    echo "<strong>$label :</strong> " . htmlspecialchars($demande[$colonne]) . "<br>";
                }
            }

            // Justificatif
            echo !empty($demande['justificatif_path']) 
                ? "<strong>Justificatif :</strong> <a href='../uploads/{$demande['justificatif_path']}' target='_blank'>Voir le fichier</a><br>" 
                : "<strong>Justificatif :</strong> Aucun fichier fourni<br>";

            if ($table === 'nouvelles_naissance') {
                if(empty($demande['cni_path'])){
                    echo !empty($demande['passeport_path'])
                        ? "<strong>Passeport :</strong> <a href='../uploads/{$demande['passeport_path']}' target='_blank'>Voir le fichier</a><br>" 
                        : "<strong>CNI/Passeport :</strong> Aucun fichier fourni<br>";
                }else{
                    echo "<strong>CNI :</strong> <a href='../uploads/{$demande['cni_path']}' target='_blank'>Voir le fichier</a><br>";
                }
            }

            if ($table === 'mariage') {
                echo !empty($demande['cni_epoux_path'])
                ? "<strong>CNI de l'époux :</strong> <a href='../uploads/{$demande['cni_epoux_path']}' target='_blank'>Voir le fichier</a><br>" 
                : "<strong>CNI de l'époux :</strong> Aucun fichier fourni<br>";
                
                echo !empty($demande['cni_epouse_path'])
                ? "<strong>CNI de l'épouse :</strong> <a href='../uploads/{$demande['cni_epouse_path']}' target='_blank'>Voir le fichier</a><br>" 
                : "<strong>CNI de l'épouse:</strong> Aucun fichier fourni<br>";
            }
            // echo $table === 'nouvelles_naissance' && !empty($demande['cni_path'])
            //     ? "<strong>Justificatif :</strong> <a href='../uploads/{$demande['justificatif_path']}' target='_blank'>Voir le fichier</a><br>" 
            //     : "<strong>Justificatif :</strong> Aucun fichier fourni<br>";

            // Statut
            echo "<strong>Statut :</strong> " . htmlspecialchars($demande['statut']) . "<br>";
            if ($demande['statut'] === 'en attente') {
                // Formulaire d'action
                echo "
                <form method='post' action='traitement_validation.php'>
                <input type='hidden' name='id' value='{$demande['id']}'>
                <input type='hidden' name='table' value='$table'>
                <label>
                <input type='radio' name='statut' value='validé' required> Valider
                </label>
                <label>
                <input type='radio' name='statut' value='refusé' required> Refuser
                </label><br>
                <label>Motif du refus (si refusé) :<br>
                <textarea name='motif_refus' rows='2' cols='40'></textarea>
                </label><br>
                <button type='submit'>Soumettre</button>
                </form>
                ";
            }
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la récupération des demandes : " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation des demandes</title>
</head>
<body>
    <h1>Validation des demandes</h1>

    <?php if ($success): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php
    afficherDemandes(
        $pdo,
        'deces',
        'Demandes d\'acte de décès',
        [
            'nom' => 'Nom',
            'prenom' => 'Prénom',
            'date_naissance' => 'Date de naissance',
            'date_deces' => 'Date de décès',
            'lieu_deces' => 'Lieu de décès',
            'cause_deces' => 'Cause du décès',
            'nombre_copies' => 'Nombre de copies',
            'justificatif_path' => 'Pièce d’identité du déclarant',
            'date_demande' => 'Date de la demande'
        ]
    );

    afficherDemandes(
        $pdo,
        'mariage',
        'Demandes d\'acte de mariage',
        [
            'nom_epoux' => 'Nom de l\'époux',
            'prenom_epoux' => 'Prénom de l\'époux',
            'nom_epouse' => 'Nom de l\'épouse',
            'prenom_epouse' => 'Prénom de l\'épouse',
            'date_mariage' => 'Date du mariage',
            'lieu_mariage' => 'Lieu du mariage',
            'temoin1' => 'Témoin 1',
            'temoin2' => 'Témoin 2',
            'cni_epoux_path' => 'Photocopie CNI des futurs époux',
            'nombre_copies' => 'Nombre de copies',
            'date_demande' => 'Date de la demande'
        ]
    );
    

    afficherDemandes(
        $pdo,
        'renouvellements_naissance',
        'Demandes d\'acte de naissance: RENOUVELLEMENT DE NAISSANCE',
        [
            'nom' => 'Nom',
            'prenom' => 'Prénom',
            'numero_extrait' => 'Numéro de l\extrait',
            'date_naissance' => 'Date de naissance',
            'lieu_naissance' => 'Lieu de naissance',
            'motif' => 'Motif de la demande',
            'nombre_copies' => 'Nombre de copies',
            'date_demande' => 'Date de la demande',
        ]
    );

    afficherDemandes(
        $pdo,
        'nouvelles_naissance',
        'Demandes d\'acte de naissance : NOUVELLES NAISSANCES',
        [
            'nom_bebe' => 'Nom du bébé',
            'date_naissance' => 'Date de naissance',
            'heure_naissance' => 'Heure de naissance',
            'lieu_naissance' => 'Lieu de naissance',
            'nom_pere' => 'Nom du père',
            'prenom_pere' => 'Prénoms du père',
            'profession_pere' => 'Profession du père',
            'nom_mere' => 'Nom de la mère',
            'prenom_mere' => 'Prénoms de la mère',
            'profession_mere' => 'Profession de la mère',
            'nombre_copies' => 'Nombre de copies',
            'date_demande' => 'Date de la demande'
        ]
    );

    ?>
</body> 
</html>
