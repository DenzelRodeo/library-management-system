<?php
$host = 'localhost'; $dbname = 'biblio'; $user = 'root'; $pass = '';

try {
    // connexion a mysql pour cibler biblio
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // gestion des erreurs pendant la connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['code_etudiant']) && !empty($_POST['code_livre']) && !empty($_POST['date_emprunt'])) {
            
            $codeEtudiant = $_POST['code_etudiant'];
            $codeLivre = $_POST['code_livre'];
            $dateEmprunt = $_POST['date_emprunt'];

           // prepation de la requete sql
            $sql = $pdo->prepare("INSERT INTO emprunter (code_etudiant, code_livre, date_emprunt) VALUES (?, ?, ?)");
            $sql->execute([$codeEtudiant, $codeLivre, $dateEmprunt]);
// redirrection vers index
            header("Location: index.php?status=success");
            exit();
            
        } else {
            // Si un champ est vide
            die("Erreur : Tous les champs du formulaire doivent être remplis.");
        }
    }
    //gestion des erreurs
} catch (PDOException $e) {
    die("Erreur lors de l'enregistrement : " . $e->getMessage());
}
?>