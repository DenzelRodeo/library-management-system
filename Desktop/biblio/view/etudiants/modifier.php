<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root'; $pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Charger les données de l'étudiant
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Ajustez 'CodeEtudiant' si votre colonne s'appelle autrement
        $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE code_etudiant = ?");
        $stmt->execute([$id]);
        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$etudiant) die("Étudiant introuvable.");
    }

    // 2. Traiter la mise à jour
    if (isset($_POST['valider_modif'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $classe = $_POST['classe'];
        $id_hidden = $_POST['id_hidden'];

        $sql = "UPDATE etudiant SET Nom = ?, Prenom = ?, Adresse = ?, Classe = ? WHERE code_etudiant = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $adresse, $classe, $id_hidden]);

        header("Location: index.php?msg=updated"); // Redirection après succès
        exit();
    }
} catch (PDOException $e) { die("Erreur : " . $e->getMessage()); }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="../../css/biblio-2.min.css" rel="stylesheet">
    <title>Modifier l'étudiant</title>
</head>
<body class="bg-gradient-primary">
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Modifier Étudiant</h6></div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_hidden" value="<?= $etudiant['code_etudiant'] ?>">
                    <div class="form-group"><label>Nom</label><input type="text" name="nom" class="form-control" value="<?= $etudiant['nom'] ?>" required></div>
                    <div class="form-group"><label>Prénom</label><input type="text" name="prenom" class="form-control" value="<?= $etudiant['prenom'] ?>" required></div>
                    <div class="form-group"><label>Adresse</label><input type="text" name="adresse" class="form-control" value="<?= $etudiant['adresse'] ?>"></div>
                    <div class="form-group"><label>Classe</label><input type="text" name="classe" class="form-control" value="<?= $etudiant['classe'] ?>"></div>
                    <button type="submit" name="valider_modif" class="btn btn-success btn-block">Enregistrer les modifications</button>
                    <a href="index.php" class="btn btn-secondary btn-block">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>