<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['name']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $classe = htmlspecialchars($_POST['classe']);

    if (!empty($nom) && !empty($prenom)) {
        try {
            $sql = "INSERT INTO etudiants (nom, prenom, adresse, classe) VALUES (:nom, :prenom, :adresse, :classe)";
            $stmt = $pdo->prepare($sql);
            
            // Exécution avec les paramètres
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':adresse' => $adresse,
                ':classe' => $classe
            ]);

            $message = "<div class='alert alert-success'>L'étudiant $prenom $nom a été enregistré avec succès !</div>";
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger'>Erreur lors de l'enregistrement : " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Veuillez remplir tous les champs obligatoires.</div>";
    }
}
?>