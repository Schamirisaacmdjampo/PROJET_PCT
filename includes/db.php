
 <?php
// db.php : Connexion à la base de données avec PDO

$host = 'localhost';
$dbname = 'etat_civil';
$username = 'root';
$password = '';

try {
    // DSN = Data Source Name
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    // Options de PDO
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions en cas d'erreur
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
        PDO::ATTR_EMULATE_PREPARES => false // Désactiver l'émulation des requêtes préparées
    ];

    // Connexion à la base de données
    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    // En cas d'erreur de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
