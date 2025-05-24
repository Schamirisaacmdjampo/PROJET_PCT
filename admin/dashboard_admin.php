<?php
include('session_admin.php'); // Sécurité admin
include('header_admin.php');
require_once('../includes/db.php'); // Connexion à la BDD

// Total de toutes les demandes
$total = 0;
$total += $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance")->fetchColumn();
$total += $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance")->fetchColumn();
$total += $pdo->query("SELECT COUNT(*) FROM mariage")->fetchColumn();
$total += $pdo->query("SELECT COUNT(*) FROM deces")->fetchColumn();

// Détail des naissances
$nouvelles_naissances = $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance")->fetchColumn();
$renouvellements_naissance = $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance")->fetchColumn();
$naissance = $nouvelles_naissances + $renouvellements_naissance;

// Mariage
$mariage = $pdo->query("SELECT COUNT(*) FROM mariage")->fetchColumn();

// Décès
$deces = $pdo->query("SELECT COUNT(*) FROM deces")->fetchColumn();

// Validées
$validees = 0;
$validees += $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance WHERE statut = 'validé'")->fetchColumn();
$validees += $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance WHERE statut = 'validé'")->fetchColumn();
$validees += $pdo->query("SELECT COUNT(*) FROM mariage WHERE statut = 'validé'")->fetchColumn();
$validees += $pdo->query("SELECT COUNT(*) FROM deces WHERE statut = 'validé'")->fetchColumn();

// En attente
$attente = 0;
$attente += $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance WHERE statut = 'en attente'")->fetchColumn();
$attente += $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance WHERE statut = 'en attente'")->fetchColumn();
$attente += $pdo->query("SELECT COUNT(*) FROM mariage WHERE statut = 'en attente'")->fetchColumn();
$attente += $pdo->query("SELECT COUNT(*) FROM deces WHERE statut = 'en attente'")->fetchColumn();

// Détail statuts naissances
$nouvelles_validees = $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance WHERE statut = 'validé'")->fetchColumn();
$nouvelles_attente = $pdo->query("SELECT COUNT(*) FROM nouvelles_naissance WHERE statut = 'en attente'")->fetchColumn();

$renouvellements_validees = $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance WHERE statut = 'validé'")->fetchColumn();
$renouvellements_attente = $pdo->query("SELECT COUNT(*) FROM renouvellements_naissance WHERE statut = 'en attente'")->fetchColumn();
?>

<h1>Tableau de Bord Administrateur</h1>

<div class="card">Total demandes: <strong><?= $total ?></strong></div>

<!-- Détail naissances -->
<div class="card">Demandes de naissance (total): <strong><?= $naissance ?></strong></div>

<div class="card" style="margin-left: 20px; background-color: #e0f7fa;">
    Nouvelles naissances : <strong><?= $nouvelles_naissances ?></strong><br>
    Validées : <strong><?= $nouvelles_validees ?></strong><br>
    En attente : <strong><?= $nouvelles_attente ?></strong>
</div>

<div class="card" style="margin-left: 20px; background-color: #ffe0b2;">
    Renouvellements d'extraits de naissance : <strong><?= $renouvellements_naissance ?></strong><br>
    Validées : <strong><?= $renouvellements_validees ?></strong><br>
    En attente : <strong><?= $renouvellements_attente ?></strong>
</div>

<div class="card">Demandes de mariage: <strong><?= $mariage ?></strong></div>
<div class="card">Demandes de décès: <strong><?= $deces ?></strong></div>
<div class="card">Demandes validées: <strong><?= $validees ?></strong></div>
<div class="card">Demandes en attente: <strong><?= $attente ?></strong></div>
