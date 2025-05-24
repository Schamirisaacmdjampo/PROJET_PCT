<?php
include(__DIR__ . '/../includes/session.php');

// Récupère le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Admin</title>
    <link rel="stylesheet" href="/PROJET PCT/assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <?php if ($current_page === 'login_admin.php'): ?>
            <a href="/PROJET PCT/index.php">Accueil</a>
        <?php else: ?>
            <?php if ($current_page !== 'dashboard_admin.php'): ?>
                <a href="/PROJET PCT/admin/dashboard_admin.php">Tableau de bord</a>
            <?php endif; ?>

            <?php if ($current_page !== 'statistiques.php'): ?>
                <a href="/PROJET PCT/admin/statistiques.php">Statistiques</a>
            <?php endif; ?>

            <?php if ($current_page !== 'validation.php'): ?>
                <a href="/PROJET PCT/admin/validation.php">Validation</a>
            <?php endif; ?>

            <a href="/PROJET PCT/admin/logout_admin.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</header>
