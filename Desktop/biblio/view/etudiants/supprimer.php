<?php
$host = 'localhost';
$dbname = 'votre_nom_bdd'; 
$user = 'root'; $pass = '';

if (isset($_GET['id'])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        
        $stmt = $pdo->prepare("DELETE FROM etudiants WHERE CodeEtudiant = ?");
        $stmt->execute([$_GET['id']]);

        // Redirection vers la liste avec un message de succès
        header("Location: index.php?msg=deleted");
    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
} else {
    header("Location: index.php");
}
exit();