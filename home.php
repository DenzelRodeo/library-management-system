 
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    
header("Location: index.php");
exit();
}
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';
$totalEtudiants = 0;
$totalLivres = 0;
$etudiants = [];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM etudiant ORDER BY code_etudiant DESC";
    $stmt = $pdo->query($query);
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalEtudiants = count($etudiants);
    $queryLivres = "SELECT COUNT(*) FROM livre";
    $totalLivres = $pdo->query($queryLivres)->fetchColumn();
    $queryEmprunt = "SELECT COUNT(*) FROM emprunter";
    $totalEmprunt = $pdo->query($queryEmprunt)->fetchColumn();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger m-3">Erreur : ' . $e->getMessage() . '</div>';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblio 2 - Tableau de Bord</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,700,800" rel="stylesheet">
    <link href="css/biblio-2.css" rel="stylesheet">

    <style>
        .bg-primary, .btn-primary, .dropdown-header { background-color: #009879 !important; border-color: #009879 !important; }
        .text-primary { color: #009879 !important; }
        .border-left-primary { border-left: .25rem solid #009879 !important; }
        .user-logo-badge {
    display: flex;
    align-items: center;
    background: #f8f9fc; /* Couleur de fond légère */
    padding: 5px 15px;
    border-radius: 50px; /* Bord arrondi style badge */
    border: 1px solid #e3e6f0;
    transition: all 0.3s ease;
    cursor: pointer;
}

.user-logo-badge:hover {
    background: #eaecf4;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.user-icon {
    color: #0866ff; /* Couleur de l'icône assortie à votre logo Biblio 2 */
    margin-right: 10px;
}

.user-name-text {
    font-weight: 700; /* Texte gras pour l'effet Logo */
    color: #4e73df;
    text-transform: capitalize; /* Première lettre en majuscule */
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}
     
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php require 'view/includes/sidebar.php' ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #009879;"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                                <div class="user-logo-badge">
                                    <svg class="user-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 18.5C6 15.4624 8.68629 13 12 13C15.3137 13 18 15.4624 18 18.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                   <span class="user-name-text">
                                       <?php echo isset($_SESSION['user_nom']) ? htmlspecialchars($_SESSION['user_nom']) : 'Admin'; ?>
                                   </span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Statistiques Globales</h1>
    
    <a href="generate_pdf.php?type=global&date=<?php echo date('Y-m-d'); ?>" 
       target="_blank" 
       class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50" id = "btnGenererPDF"></i> Générer Rapport PDF (<?php echo date('d/m/Y'); ?>)
    </a>
</div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Étudiants Inscrits</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalEtudiants; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Livres en Stock</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalLivres ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Emprunts</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalEmprunt ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gestion des Ressources</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Bienvenue sur l'interface de gestion <strong>Biblio 2</strong>. Vous pouvez ici gérer les stocks de livres, suivre les emprunts et administrer les comptes étudiants en quelques clics.</p>
                                    <a href="liste_livres.php">Consulter le catalogue &rarr;</a>
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

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Prêt à partir ?</h5>
                    <button class="close" type="button" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à fermer votre session actuelle.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/biblio-2.min.js"></script>
    <script>
    // On cible le bouton par son ID
    document.getElementById('btnGenererPDF').addEventListener('click', function(e) {
        let icon = this.querySelector('i');
        
        // 1. On change l'icône de téléchargement en icône de chargement
        icon.classList.remove('fa-download');
        icon.classList.add('fa-spinner', 'fa-spin'); 
        
        // 2. On attend 3 secondes avant de remettre l'icône originale
        setTimeout(() => {
            icon.classList.remove('fa-spinner', 'fa-spin');
            icon.classList.add('fa-download');
        }, 3000); 
    });
</script>

</body>
</html>