<?php
session_start();
if (!isset($_SESSION['id'])) {
    
header("Location: ../../index.php");
exit();
}
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

$livres = []; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM livre ORDER BY code_livre DESC";
    $stmt = $pdo->query($query);
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($livres[0]); die();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger m-3">Erreur de base de données : ' . $e->getMessage() . '</div>';
}?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblio 2 - Liste des Livres</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,700,800" rel="stylesheet">
    <link href="../../css/biblio-2.css" rel="stylesheet">

    <style>
        /* Thème Vert Émeraude */
        .bg-primary, .btn-primary { background-color: #009879 !important; border-color: #009879 !important; }
        .text-primary { color: #009879 !important; }
        
        /* Style du Tableau Moderne */
        #datatablesSimple {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        #datatablesSimple thead {
            background-color: #009879;
            color: white;
        }
        #datatablesSimple th, #datatablesSimple td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        #datatablesSimple tbody tr:hover {
            background-color: #f9f9f9;
        }
        .badge-stock {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
        }
        .in-stock { background-color: #d4edda; color: #155724; }
        .out-stock { background-color: #f8d7da; color: #721c24; }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
       <div style="display:flex; flex-direction: row">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-book-reader"></i>
                    </div>
                   <div class="sidebar-brand-text mx-3" style="font-weight: bolder">Biblio <sup>2</sup></div>
              </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="../../index.php">
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

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #009879;"></i>
                    </button>

                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Rechercher par titre, auteur ou code...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Catalogue des Livres</h1>
                        <a href="../emprunts/ajouter.php" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Emprunter un livre
                        </a>
                        <a href="ajouter.php" class="btn btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un livre
                        </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                       <tr>
                                            <th>Code</th>
                                            <th>Titre</th>
                                            <th>Auteur</th>
                                            <th>Date d'Édition</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if (!empty($livres)): ?>
                                            <?php foreach ($livres as $liv): ?>
                                                <tr>
                                                    <td>LIV00<?= htmlspecialchars($liv['code_livre']) ?></td>
                                                    <td><?= htmlspecialchars($liv['titre']) ?></td>
                                                    <td><?= htmlspecialchars($liv['auteur']) ?></td>
                                                    <td><?= htmlspecialchars($liv['date_edition']) ?></td>
                                                    <td style = "display:flex">
                                        <a href="modifier.php?id=<?= $liv['code_livre'] ?>">
        <button class="btn btn-sm btn-info">
            <i class="fas fa-edit" value= "">modifier</i>
        </button>
    </a>

    <a href="supprimer.php?id=<?= $liv['code_livre'] ?>" onclick="return confirm('Supprimer ce livre ?');">
        <button class="btn btn-sm btn-danger">
            <i class="fas fa-trash">supprimer</i>
        </button>
    </a>
</td>   
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

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelector('#datatablesSimple tbody').rows;

            for (let i = 0; i < rows.length; i++) {
                let text = rows[i].textContent.toLowerCase();
                rows[i].style.display = text.includes(filter) ? '' : 'none';
            }
        });
    </script>
</body>
</html>