<?php
$host = 'localhost';
$dbname = 'biblio'; 
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 // jointure
    $query = "SELECT e.*, et.nom, et.prenom, l.titre 
              FROM emprunter e
              LEFT JOIN etudiant et ON e.code_etudiant = et.code_etudiant
              LEFT JOIN livre l ON e.code_livre = l.code_livre
              ORDER BY e.date_emprunt DESC";

    $stmt = $pdo->query($query);
    $emprunts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('<div class="alert alert-danger">Erreur de connexion/requête : ' . $e->getMessage() . '</div>');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblio 2 - Gestion des Emprunts</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,700,800" rel="stylesheet">
    <link href="../../css/biblio-2.min.css" rel="stylesheet">

    <style>
        /* Thème Vert Émeraude */
        .bg-primary, .btn-primary { background-color: #009879 !important; border-color: #009879 !important; }
        .text-primary { color: #009879 !important; }

        /* Correction mise en page globale */
        #content-wrapper { width: 100%; }

        /* Style du Tableau Moderne */
        #datatablesSimple {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
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
        #datatablesSimple tbody tr:hover { background-color: #f8f9fc; }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: bold;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-book-reader"></i></div>
                <div class="sidebar-brand-text mx-3">Biblio <sup>2</sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-fw fa-tachometer-alt"></i><span>Accueil</span></a></li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Interface</div>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEtudiants"><i class="fas fa-fw fa-user-graduate"></i> <span>Etudiants</span></a>
                <div id="collapseEtudiants" class="collapse"><div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item" href="../etudiants/index.php">Liste</a></div></div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLivres"><i class="fas fa-fw fa-book"></i> <span>Livres</span></a>
                <div id="collapseLivres" class="collapse"><div class="bg-white py-2 collapse-inner rounded"><a class="collapse-item" href="../livres/index.php">Liste</a></div></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../emprunts/index.php"><i class="fas fa-fw fa-exchange-alt"></i> <span>Emprunts</span></a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Rechercher un emprunt...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
                            </div>
                        </div>
                    </form>
                </nav>

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Gestion des Emprunts</h1>
                    <p class="mb-4">Consultez et gérez les prêts de livres en cours.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des Emprunts</h6>
                            <a href="ajouter.php" class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-plus fa-sm"></i> Nouvel Emprunt</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Code Étudiant</th>
                                            <th>Code Livre</th>
                                            <th>Date Emprunt</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  <tbody>
     <?php if (!empty($emprunts)): ?>
        <?php foreach ($emprunts as $emp): ?>
            <tr>
                <td>
                    <strong>ETU00<?= htmlspecialchars($emp['code_etudiant']) ?></strong><br>
                    <small class="text-muted"><?= htmlspecialchars($emp['nom'] . ' ' . $emp['prenom']) ?></small>
                </td>
                
                <td>
                    <strong><?= htmlspecialchars($emp['code_livre']) ?></strong><br>
                    <small class="text-muted"><?= htmlspecialchars($emp['titre']) ?></small>
                </td>
                
                <td><?= date('d/m/Y', strtotime($emp['date_emprunt'])) ?></td>
                
                <td>
                    <span class="badge badge-warning">En cours...</span>
                </td>
                
                <td>
                    <a href="supprimer_emprunt.php?id_etudiant=<?= $emp['code_etudiant'] ?>&id_livre=<?= $emp['code_livre'] ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Supprimer cet emprunt ?')">
                        <i class="fas fa-trash"></i>
                    </a>
                
                    <a href="modifier_emprunt.php?code_etudiant=<?= $ligne['code_etudiant'] ?>&code_livre=<?= $ligne['code_livre'] ?>&date=<?= $ligne['date_emprunt'] ?>" 
                        class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
</td>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">Aucun emprunt enregistré.</td>
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
                <div class="container my-auto"><div class="copyright text-center my-auto"><span>Copyright &copy; Biblio 2026</span></div></div>
            </footer>
        </div>
    </div>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/biblio-2.min.js"></script>
    
    <script>
        
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#datatablesSimple tbody tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>