<?php
// session_start();
include(__DIR__ . '/includes/session.php');
include(__DIR__ . '/templates/header.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Sécurise avec opérateur null coalescent
$prenom = $_SESSION['user_prenom'] ?? '';
$nom = $_SESSION['user_nom'] ?? '';
?>

<h1>Tableau de bord</h1>
<p>Bienvenue, <?= htmlspecialchars($prenom . ' ' . $nom) ?> !</p>
<a href="logout.php">Se déconnecter</a>


<?php
include(__DIR__ . '/templates/footer.php');
?>
