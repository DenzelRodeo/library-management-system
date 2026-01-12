<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

$etudiants = []; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM etudiant ORDER BY code_etudiant DESC";
    $stmt = $pdo->query($query);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($etudiants[0]); die();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger m-3">Erreur de base de données : ' . $e->getMessage() . '</div>';
}?>
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
    <link href="../../css/biblio-2.min.css" rel="stylesheet">

</head>
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" id="searchInput" class="form-control bg-light border-0 small" 
               placeholder="Recherche un étudiant..." aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../../img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../../img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../../img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Jordan Tsane</span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
    <div style = "display:flex ; flex-direction : row">
      
      
<div style="display:flex; flex-direction: row">
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
    
    </div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Etudiants</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Consulter la liste des etudiants</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header" style="display: flex; justify-content: flex-end">
                <a href="ajouter.php" class="btn btn-primary btn-sm">Ajouter un etudiant</a>
            </div>
            <div class="card-body">
    <table id="datatablesSimple">
        <thead>
            <tr>
            <th>CodeEtudiant</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Adresse</th>
            <th>Classe</th>
            <th>Actions</th> </tr>
      </thead>
      <tbody>
                                        <?php if (!empty($etudiants)): ?>
                                            <?php foreach ($etudiants as $etu): ?>
                                                <tr>
                                                    <td>ETU00<?= htmlspecialchars($etu['code_etudiant']) ?></td>
                                                    <td><?= htmlspecialchars($etu['nom']) ?></td>
                                                    <td><?= htmlspecialchars($etu['prenom']) ?></td>
                                                    <td><?= htmlspecialchars($etu['adresse']) ?></td>
                                                    <td><?= htmlspecialchars($etu['classe']) ?></td>
                                                    <td>
                                                        <a href="modifier.php?id=<?= $etu['code_etudiant'] ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="supprimer.php?id=<?= $id ?>" 
                                                           class="btn btn-danger btn-sm" 
                                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">
                                                          <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune donnée trouvée.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
</table>
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
    <script src="../js/demo/chart-pie-demo.js"></script>
<style>
    /* Style global pour le tableau */
 #datatablesSimple {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px 8px 0 0;
    overflow: hidden;
 }

 /* En-tête du tableau */
 #datatablesSimple thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
 }

 #datatablesSimple th, 
 #datatablesSimple td {
    padding: 12px 15px;
 }

 /* Lignes du corps du tableau */
 #datatablesSimple tbody tr {
    border-bottom: 1px solid #dddddd;
 }

 /* Couleur alternée pour les lignes (Zebra stripes) */
 #datatablesSimple tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
 }

 /* Effet au survol de la souris */
 #datatablesSimple tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
 }

 /* Style de la dernière ligne */
 #datatablesSimple tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
 }

 /* Style spécifique pour le bouton Supprimer */
 .btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
 }

 .btn-danger:hover {
    background-color: #c0392b;
 }
</style>
