<?php
include(__DIR__ . '/../includes/db.php');
include(__DIR__ . '/../includes/session.php');

$error = '';
$success = '';

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];

    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password)) {
        $error = "Tous les champs doivent être remplis.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO citoyens (nom, prenom, email, telephone, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $telephone, $hashedPassword]);

            $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
            header("refresh:3;url=login.php");
            exit;

        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $error = "Cet email est déjà utilisé.";
            } else {
                $error = "Erreur : " . $e->getMessage();
            }
        }
    }
}
?>
