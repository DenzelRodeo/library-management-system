
<?php
// 1. CONFIGURATION DE LA CONNEXION
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

$message = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. TRAITEMENT DE L'ENVOI 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données avec vos noms de champs actuels
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $dateEdition = $_POST['date_edition'];

        if (!empty($titre) && !empty($auteur)) {
            $sql = "INSERT INTO livre (titre, auteur, date_edition) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $auteur, $dateEdition]);

            $message = '<div class="alert alert-success shadow">📚 Livre enregistré avec succès !</div>';
        } else {
            $message = '<div class="alert alert-warning shadow">⚠️ Veuillez remplir le titre et l\'auteur.</div>';
        }
    }
} catch (PDOException $e) {
    $message = '<div class="alert alert-danger shadow">❌ Erreur : ' . $e->getMessage() . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Biblio 2 - Gestion de bibliotheque</title>

    <!-- Custom fonts for this template-->
      <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/biblio-2.css" rel="stylesheet">

</head>
  
    <div style = "display:flex ; flex-direction : row">
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
      
   <div class="container-fluid px-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><h1 class="mt-4">Enregistrer un Livre</h1></li>
    </ol>

    <?php echo $message; ?>

    <div class="card my-4 p-3 shadow">
        <div class="card-body">
            <form action="" enctype="multipart/form-data" method="post">

                <div class="form-group mb-4">
                    <label for=""><strong>Titre</strong></label>
                    <input type="text" name="titre" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for=""><strong>Auteur</strong></label>
                    <input type="text" name="auteur" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for=""><strong>Date d'Édition</strong></label>
                    <input type="date" name="date_edition" class="form-control" required>
                </div>

                <div style="display: flex; justify-content:center;align-items:center">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save mr-2"></i> Enregistrer le livre
                    </button>
                </div>
            </form>
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
            
    <!-- Custom scripts for all pages-->
    <script src="../../js/biblio-2.min.js"></script>
        <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>
