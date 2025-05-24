<?php
session_start();
?>

<main>
    <h1>Bienvenue sur la plateforme d'état civil</h1>
    <p>Gérez vos actes de naissance, de mariage et de décès en ligne.</p>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p><a href="login.php">Se connecter</a> | <a href="register.php">Créer un compte</a></p>
    <?php else: ?>
        <p><a href="/PROJET PCT/dashboard.php">Accéder au tableau de bord</a></p>
        <p><a href="/PROJET PCT/demande/demande.php">Faire une demande</a></p>
    <?php endif; ?>
</main>

<?php
include(__DIR__ .'/templates/footer.php');
?>
<p style="text-align: center; font-size: 0.9em; margin-top: 20px;">
    <a href="admin/login_admin.php" style="color: #555;">Connexion administrateur</a>
</p>
