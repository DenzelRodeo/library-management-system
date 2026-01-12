
<?php

$host = 'localhost'; $dbname = 'biblio'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les étudiants
    $listeEtudiants = $pdo->query("SELECT code_etudiant, nom, prenom FROM etudiant")->fetchAll(PDO::FETCH_ASSOC);
    
    // Récupérer les livres (Ajustez les noms de colonnes si besoin)
    $listeLivres = $pdo->query("SELECT code_livre, titre , auteur FROM livre")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblio 2 - Ajouter un Emprunt</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,700,800" rel="stylesheet">
    <link href="../../css/biblio-2.min.css" rel="stylesheet">

    <style>
        .bg-primary, .btn-primary { background-color: #009879 !important; border-color: #009879 !important; }
        .text-primary { color: #009879 !important; }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 2px solid #009879;
        }
        
        .form-control:focus {
            border-color: #009879;
            box-shadow: 0 0 0 0.2rem rgba(0, 152, 121, 0.25);
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include '../../view/includes/sidebar.php';  ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="h4 mb-0 text-gray-800 ml-4">Nouveau Prêt</h1>
                </nav>

                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregistrer un emprunt</h6>
                                </div>
                                <div class="card-body">
                                    <form action="traitement_ajouter.php" method="POST">
                                        <div class="form-group">
                                            <label for="codeEtudiant"><strong>Etudiant</strong></label>
                                           <select class="form-control" id="codeEtudiant" name="code_etudiant" required>
                                                <option value="">-- Choisir un étudiant --</option>
                                                    <?php foreach ($listeEtudiants as $etu): ?>
                                                <option value="<?= $etu['code_etudiant'] ?>">
                                                        <?= htmlspecialchars($etu['nom'] . " " . $etu['prenom']) ?>
                                            </option>
                                                <?php endforeach; ?>
                                           </select>
                                       <label for="codeLivre"><strong>Livre à emprunter</strong></label>
                                       <select class="form-control" id="codeLivre" name="code_livre" required>
                                             <option value="">-- Choisir un livre --</option>
                                                <?php foreach ($listeLivres as $livre): ?>
                                           <option value="<?= $livre['code_livre'] ?>">
                                                <?= htmlspecialchars($livre['titre']) ?>
                                        </option>
                                                <?php endforeach; ?>
                                        </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dateEmprunt"><strong>Date de l'emprunt</strong></label>
                                            <input type="date" class="form-control" id="dateEmprunt" name="date_emprunt" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fas fa-save mr-2"></i> Confirmer l'emprunt
                                            </button>
                                            <a href="index.php" class="btn btn-secondary btn-block">
                                                Annuler
                                            </a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Biblio 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/biblio-2.min.js"></script>
</body>
</html>