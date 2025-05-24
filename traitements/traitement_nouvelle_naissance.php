    <?php
session_start();
require_once(__DIR__ . '/../includes/db.php');

// Vérifie que le formulaire a bien été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération des champs du formulaire
    $nom_bebe = $_POST['nom_bebe'];
    $date_naissance = $_POST['date_naissance'];
    $heure_naissance = $_POST['heure_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];

    $nom_pere = $_POST['nom_pere'];
    $prenom_pere = $_POST['prenom_pere'];
    $profession_pere = $_POST['profession_pere'];

    $nom_mere = $_POST['nom_mere'];
    $prenom_mere = $_POST['prenom_mere'];
    $profession_mere = $_POST['profession_mere'];

    $nombre_copies = (int)$_POST['nombre_copies'];

    // Préparation du dossier d’upload
    $dossier_upload = __DIR__ . '/../uploads/';
    if (!is_dir($dossier_upload)) {
        mkdir($dossier_upload, 0777, true);
    }

    $cni_path = null;
    $passeport_path = null;
    
    // Upload CNI
    if (isset($_FILES['CNI']) && $_FILES['CNI']['error'] === UPLOAD_ERR_OK) {
        $cni_name = uniqid('cni_') . '.pdf';
        $cni_path = $dossier_upload . $cni_name;
        move_uploaded_file($_FILES['CNI']['tmp_name'], $cni_path);
    }

    // Upload Passeport
    if (isset($_FILES['passeport']) && $_FILES['passeport']['error'] === UPLOAD_ERR_OK) {
        $passeport_name = uniqid('passeport_') . '.pdf';
        $passeport_path = $dossier_upload . $passeport_name;
        move_uploaded_file($_FILES['passeport']['tmp_name'], $passeport_path);
    }

    try {
        // Préparer l’insertion en base de données
        $stmt = $pdo->prepare("
            INSERT INTO nouvelles_naissance (
                nom_bebe, date_naissance, heure_naissance, lieu_naissance,
                nom_pere, prenom_pere, profession_pere,
                nom_mere, prenom_mere, profession_mere,
                cni_path, passeport_path, nombre_copies
            ) VALUES (
                :nom_bebe, :date_naissance, :heure_naissance, :lieu_naissance,
                :nom_pere, :prenom_pere, :profession_pere,
                :nom_mere, :prenom_mere, :profession_mere,
                :cni_path, :passeport_path, :nombre_copies
            )
        ");

        // Exécuter avec les données
        $stmt->execute([
            ':nom_bebe' => $nom_bebe,
            ':date_naissance' => $date_naissance,
            ':heure_naissance' => $heure_naissance,
            ':lieu_naissance' => $lieu_naissance,

            ':nom_pere' => $nom_pere,
            ':prenom_pere' => $prenom_pere,
            ':profession_pere' => $profession_pere,

            ':nom_mere' => $nom_mere,
            ':prenom_mere' => $prenom_mere,
            ':profession_mere' => $profession_mere,

            ':cni_path' => $cni_name ?? null, // Si la CNI n'est pas fournie, on met null
            ':passeport_path' => $passeport_name ?? null, // Si le passeport n'est pas fourni, on met null
            ':nombre_copies' => $nombre_copies
        ]);

        // Redirection vers la page de paiement
       header("Location: ../paiement.php");
        exit;

    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }

} else {
    echo "Méthode non autorisée.";
}
