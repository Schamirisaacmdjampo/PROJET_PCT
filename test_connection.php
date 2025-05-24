<?php
// Informations de connexion à la base de données
$host = "localhost";
$dbname = "etat_civil";
$username = "root";
$password = "";

try {
    // Création d'une instance PDO avec les bons paramètres
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuration des attributs d'erreur de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie avec PDO !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
