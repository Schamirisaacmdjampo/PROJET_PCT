<?php
session_start();
require_once('../includes/db.php');

// Récupération et nettoyage des données
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';

if ($email && $mot_de_passe) {
    // Préparation de la requête
    $sql = "SELECT id, mot_de_passe FROM admins WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $email;
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Erreur de connexion
        header("Location: login_admin.php?erreur=Email ou mot de passe incorrect");
        exit();
    }
} else {
    header("Location: login_admin.php?erreur=Champs requis manquants");
    exit();
}
