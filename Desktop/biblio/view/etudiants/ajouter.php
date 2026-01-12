<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';
$message = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['enregistrer'])) { 
        $nom = $_POST['name'];
        $prenom = $_POST['Prenom'];
        $adresse = $_POST['adresse'];
        $classe = $_POST['classe'];

        if (!empty($nom) && !empty($prenom)) {
            $sql = "INSERT INTO etudiant (nom, prenom, adresse, classe) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $adresse, $classe]);

            $message = '<div class="alert alert-success shadow">🎉 Étudiant enregistré avec succès !</div>';
        } else {
            $message = '<div class="alert alert-warning shadow">⚠️ Veuillez remplir le nom et le prénom.</div>';
        }
    }
} catch (PDOException $e) {
    $message = '<div class="alert alert-danger shadow">❌ Erreur : ' . $e->getMessage() . '</div>';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblio 2 - Enregistrer un Étudiant</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/biblio-2.min.css" rel="stylesheet">

    <style>
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .btn-custom-save {
            background-color: #009879;
            border: none;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-custom-save:hover {
            background-color: #007d63;
            color: white;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3" style="font-weight: bolder">Biblio <sup>2</sup></div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Acceuil</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Interface</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEtudiants"
                aria-expanded="true" aria-controls="collapseEtudiants">
                <i class="fas fa-fw fa-user-graduate"></i> <span>Etudiant</span>
            </a>
            <div id="collapseEtudiants" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion Etudiant:</h6>
                    <a class="collapse-item" href="../../view/etudiants/index.php">Liste des etudiants</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLivres"
                aria-expanded="true" aria-controls="collapseLivres">
                <i class="fas fa-fw fa-book"></i> <span>Livres</span>
            </a>
            <div id="collapseLivres" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion des Livres:</h6>
                    <a class="collapse-item" href="../../view/livres/index.php">Liste des livres</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmprunts"
                aria-expanded="true" aria-controls="collapseEmprunts">
                <i class="fas fa-fw fa-exchange-alt"></i> <span>Emprunts des livres</span>
            </a>
            <div id="collapseEmprunts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestion des Emprunts :</h6>
                    <a class="collapse-item" href="../../view/emprunts/index.php">Liste des Emprunts</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="../../img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>Biblio Pro</strong> pour plus de fonctionnalités !</p>
            <a class="btn btn-success btn-sm" href="#">Passer à la version pro!</a>
        </div>
    </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php require '../includes/topbar.php' ?>

                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Gestion des Étudiants</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                            <li class="breadcrumb-item active">Enregistrer un Étudiant</li>
                        </ol>
                    </nav>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="form-container">
                                <form action="#" enctype="multipart/form-data" method="post">
                                    <h2 class="text-center mb-4" style="color: #333;">Ajouter un Étudiant</h2>
                                      <?php echo $message; ?>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nom</label>
                                        <input type="text" name="name" class="form-control form-control-user" placeholder="Ex: Dupont" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Prénom</label>
                                        <input type="text" name="Prenom" class="form-control form-control-user" placeholder="Ex: Jean" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Adresse</label>
                                        <input type="text" name="adresse" class="form-control form-control-user" placeholder="Ex: 12 rue des Fleurs" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Classe</label>
                                        <input type="text" name="classe" class="form-control form-control-user" placeholder="Ex: Master 1" required>
                                    </div>

                                    <button type="submit" name="enregistrer" class="btn btn-custom-save btn-block p-3 mt-4">
                                        <i class="fas fa-save"></i> Enregistrer l'étudiant
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            <?php require '../includes/footer.php' ?>

        </div>
        </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/biblio-2.min.js"></script>
</body>

</html>