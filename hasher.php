<?php
$motDePasse = "Bankai"; // Remplace par ton mot de passe
$hash = password_hash($motDePasse, PASSWORD_DEFAULT);
echo $hash;
?>
