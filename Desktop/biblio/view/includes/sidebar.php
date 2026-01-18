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
                    <a class="collapse-item" href="view/etudiants/index.php">Liste des etudiants</a>
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
                    <a class="collapse-item" href="view/livres/index.php">Liste des livres</a>
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
                    <a class="collapse-item" href="view/emprunts/index.php">Liste des Emprunts</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>Biblio Pro</strong> pour plus de fonctionnalités !</p>
            <a class="btn btn-success btn-sm" href="#">Passer à la version pro!</a>
        </div>
    </ul>
    
    </div>