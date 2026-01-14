<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root'; $pass = '';

if (isset($_GET['id'])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        // prepation de la requete sql
        $sql = $pdo->prepare("DELETE FROM livre WHERE code_livre = ?");
       // execution
        $sql->execute([$_GET['id']]);

        // Redirection vers la liste avec un message de succès
        header("Location: index.php?msg=deleted");
        // gestion des erreurs
    } catch (PDOException $e) {
        die("Erreur de suppression : " . $e->getMessage());
    }
} else {
    header("Location: index.php");
}
//
exit();