<?php
include(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Renouvellement d’extrait de naissance</h2>
<p>Veuillez remplir les informations suivantes :</p>

<form action="../traitements/traitement_renouvellement_naissance.php" method="POST" style="max-width: 600px;">

    <label>Nom:</label>
    <input type="text" name="nom" required>

    <label>prénoms :</label>
    <input type="text" name="prenom" required>

    <label>Numéro de l'extrait :</label>
    <input type="text" name="numero_extrait">

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance" required>

    <label>Lieu de naissance :</label>
    <input type="text" name="lieu_naissance" required>

    <label>Motif de la demande :</label>
    <select name="motif" required>
        <option value="">-- Sélectionnez un motif --</option>
        <option value="perte">Perte</option>
        <option value="deterioration">Détérioration</option>
        <option value="dossier administratif">Pour des dossiers administratifs</option>
    </select>

    <label>Nombre de copies demandées :</label>
    <input type="number" name="nombre_copies" min="1" required>

    <button type="submit" class="btn">Soumettre la demande</button>
</form>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
