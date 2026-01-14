<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root'; $pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Charger les données du livre
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM livre WHERE code_livre = ?");
        $stmt->execute([$id]);
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$livre) die("livre introuvable.");
    }

    // 2. Traiter la mise à jour
    if (isset($_POST['valider_modif'])) {
        $titre= $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date_edition = $_POST['date'];
        $id_hidden = $_POST['id_hidden'];

        $sql = "UPDATE livre SET titre = ?, auteur = ?, date_edition = ? WHERE code_livre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $auteur, $date_edition,$id_hidden]);

        header("Location: index.php?msg=updated"); // Redirection après succès
        exit();
    }
} catch (PDOException $e) { die("Erreur : " . $e->getMessage()); }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="../../css/biblio-2.css" rel="stylesheet">
    <title>Modifier les information du livre</title>
</head>
<body class="bg-gradient-primary">
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Modifier Livre</h6></div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="id_hidden" value="<?= $livre['code_livre'] ?>">
                    <div class="form-group"><label>Titre</label><input type="text" name="titre" class="form-control" value="<?= $livre['titre'] ?>" required></div>
                    <div class="form-group"><label>Auteur</label><input type="text" name="auteur" class="form-control" value="<?= $livre['auteur'] ?>" required></div>
                    <div class="form-group"><label>Date_Edition</label><input type="date" name="date" class="form-control" value="<?= $livre['date_edition'] ?>" required></div>
                    <button type="submit" name="valider_modif" class="btn btn-success btn-block">Enregistrer les modifications</button>
                    <a href="index.php" class="btn btn-secondary btn-block">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>