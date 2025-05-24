<?php
include(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Demande d’acte de mariage</h2>
<p>Veuillez remplir les informations du mariage :</p>

<form action="../traitements/traitement_mariage.php" method="POST" enctype="multipart/form-data" style="max-width: 600px;">

    <fieldset>
        <legend>Informations sur les époux</legend>

        <label>Nom de l’époux :</label>
        <input type="text" name="nom_epoux" required><br>

        <label>Prénom(s) de l’époux :</label>
        <input type="text" name="prenom_epoux" required><br>

        <label>Nom de l’épouse :</label>
        <input type="text" name="nom_epouse" required><br>

        <label>Prénom(s) de l’épouse :</label>
        <input type="text" name="prenom_epouse" required><br>
    </fieldset>

    <fieldset>
        <legend>Détails du mariage</legend>

        <label>Date du mariage :</label>
        <input type="date" name="date_mariage" required><br>

        <label>Lieu du mariage :</label>
        <input type="text" name="lieu_mariage" required><br>
    </fieldset>

    <fieldset>
        <legend>Documents justificatifs</legend>

        <label>Photocopie CNI des futurs époux (PDF) :</label>
        <input type="file" name="justificatif_cni" accept="application/pdf" ><br>

        <label>Nom du témoin 1 :</label>
        <input type="text" name="temoin1" required><br>

        <label>Nom du témoin 2 :</label>
        <input type="text" name="temoin2" required><br>
    </fieldset>

    <label>Nombre de copies demandées :</label>
    <input type="number" name="nombre_copies" min="1" required><br><br>

    <button type="submit" class="btn">Soumettre la demande</button>
</form>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
