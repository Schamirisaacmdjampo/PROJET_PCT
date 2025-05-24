<?php
include(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Demande d’acte de décès</h2>
<p>Veuillez remplir les informations concernant le défunt :</p>

<form action="../traitements/traitement_deces.php" method="POST" enctype="multipart/form-data" style="max-width: 600px;">

    <fieldset>
        <legend>Informations sur le défunt</legend>
        <label>Nom du défunt :</label>
        <input type="text" name="nom" required><br>

        <label>Prénom(s) du défunt :</label>
        <input type="text" name="prenom" required><br>

        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" required><br>

        <label>Date du décès :</label>
        <input type="date" name="date_deces" required><br>

        <label>Cause du décès :</label>
        <input type="text" name="cause_deces" required><br>

        <label>Lieu du décès :</label>
        <input type="text" name="lieu_deces" required><br>
    </fieldset>ss

    <fieldset>  
        <legend>Document justificatif (PDF)</legend>
        <label>Pièce d’identité du déclarant ou certificat médical de décès (max 2Mo) :</label>
        <input type="file" name="justificatif" accept="application/pdf"><br>
    </fieldset>

    <label>Nombre de copies demandées :</label>
    <input type="number" name="nombre_copies" min="1" required><br><br>

    <button type="submit" class="btn">Soumettre la demande</button>
</form>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
