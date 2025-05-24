<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: ../dashboard_admin.php");
    exit();
}
include(__DIR__ . '/header_admin.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion administrateur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>Connexion administrateur</h2>

<form action="traitement_login_admin.php" method="POST" style="max-width: 400px;">
    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required>

    <button type="submit">Se connecter</button>
</form>

<?php if (isset($_GET['erreur'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_GET['erreur']); ?></p>
<?php endif; ?>

</body>
</html>


<?php
include(__DIR__ . '/../templates/footer.php');
?>