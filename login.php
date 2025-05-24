<?php
include(__DIR__ . '/includes/db.php');
include(__DIR__ . '/includes/session.php');
include(__DIR__ . '/templates/header.php');
include(__DIR__ . '/traitements/login_traitement.php');
?>

<!-- Formulaire de connexion -->
<form action="login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Se connecter</button>
</form>

<?php
// Affiche le message d'erreur s'il y en a un
if (!empty($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>

<?php include(__DIR__ . '/templates/footer.php'); ?>
