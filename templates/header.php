<?php
include(__DIR__ . '/../includes/session.php');

// Récupère le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme État Civil</title>
    <link rel="stylesheet" href="/PROJET PCT/assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <!-- Lien vers l’accueil sauf si on y est déjà -->
        <?php if ($current_page !== 'index.php'): ?>
            <a href="/PROJET PCT/index.php">Accueil</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Utilisateur connecté -->
            
            <?php if ($current_page !== 'dashboard.php'): ?>
                <a href="/PROJET PCT/dashboard.php">Tableau de bord</a>
            <?php endif; ?>

            <?php if ($current_page !== 'demande.php'): ?>
                <a href="/PROJET PCT/demande/demande.php">Faire une demande</a>
            <?php endif; ?>

            <!-- Toujours afficher Déconnexion -->
            <?php if ($current_page !== 'dashboard.php'): ?>
                    <a href="/PROJET PCT/logout.php">Déconnexion</a>
            <?php endif; ?>


        <?php else: ?>
            <!-- Utilisateur non connecté -->

            <?php if ($current_page !== 'login.php'): ?>
                <a href="/PROJET PCT/login.php">Connexion</a>
            <?php endif; ?>

            <?php if ($current_page !== 'register.php'): ?>
                <a href="/PROJET PCT/register.php">Inscription</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
</header>
