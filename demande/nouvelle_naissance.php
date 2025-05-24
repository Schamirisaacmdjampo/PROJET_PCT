<?php
include(__DIR__ . '/../includes/session.php');
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Nouvelle demande d’extrait de naissance</h2>
<p>Veuillez remplir soigneusement les informations ci-dessous :</p>

<form action="../traitements/traitement_nouvelle_naissance.php" method="POST" enctype="multipart/form-data" style="max-width: 600px;">

    <fieldset>
        <legend>Informations sur le bébé</legend>
        <label>Nom du bébé :</label>
        <input type="text" name="nom_bebe" required>

        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" required>

        <label>Heure de naissance :</label>
        <input type="time" name="heure_naissance" required>

        <label>Lieu de naissance (ville/village/commune) :</label>
        <input type="text" name="lieu_naissance" required>
    </fieldset>

    <fieldset>
        <legend>Informations sur les parents</legend>
        <label>Nom du père :</label>
        <input type="text" name="nom_pere" required>

        <label>Prénoms du père :</label>
        <input type="text" name="prenom_pere" required>

        <label>Profession du père :</label>
        <input type="text" name="profession_pere" required>

        <label>Nom de la mère :</label>
        <input type="text" name="nom_mere" required>

        <label>Prénoms de la mère :</label>
        <input type="text" name="prenom_mere" required>

        <label>Profession de la mère :</label>
        <input type="text" name="profession_mere" required>
    </fieldset>

    <fieldset>
        <legend>Pièce d’identité (au moins une)</legend>
        <label>Carte Nationale d’Identité (PDF, max 2Mo) :</label>
        <input type="file" name="CNI" accept="application/pdf">

        <label>Passeport (PDF, max 2Mo) (si CNI indisponible) :</label>
        <input type="file" name="passeport" accept="application/pdf">
    </fieldset>

    <label>Nombre de copies demandées :</label>
    <input type="number" name="nombre_copies" min="1" required>

    <button type="submit" class="btn">Soumettre la demande</button>
</form>

<?php
include(__DIR__ . '/../templates/footer.php');
?>
