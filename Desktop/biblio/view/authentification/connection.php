<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Biblio 2 - Connection</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/biblio-2.min.css" rel="stylesheet">

</head>

<body style = " background-color: #f2f4f6;">
    

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../index.php" style = "font-size : 30px;font-family:times roman">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Biblio <sup>2</sup></div>
            </a>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
</nav>.
         
     <div class="container">
         <div class="row">
             <div class="col-md-6 offset-md-3">
                 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" style = "font-size : 30px;font-family:times roman">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Biblio <sup>2</sup></div>
            </a>

                 </h2>
                 <div class="text-center mb-5 text-dark"style="font-family:Arial, Helvetica, sans-serif"><h1>Page de connection</h1>
                     </div>
                 <div class="card my-5">
                     <form class="card-body cardbody-color p-lg-5" method="post" action="#">
                         <div class="text-center">
                             <img src="https://thumbs.dreamstime.com/z/ic%C3%B4ne-solide-noire-pour-le-magasin-et-la-vente-au-d%C3%A9tail-logo-symbole-divers-147167501.jpg"
                                 class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                 alt="profile">
                         </div>

                         <div class="mb-3">
                             <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                 placeholder="Nom & Prenom" name="name" >
                         </div>
                         <div class="mb-3">
                             <input type="email" class="form-control" id="email" placeholder="exemple@gmail.com"
                                 name="email">
                         </div>
                         <div class="mb-3">
                             <input type="password" class="form-control" id="password" placeholder="Mot de passe"
                                 name="password">
                         </div>
                         <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Acceder au tableau de bord</button></div>
                         <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                             Pas de compte? <br> <br> =><a href="inscription.php" class="text-dark fw-bold"
                                 style="text-decoration:underline">
                                 Inscrivez-Vous
                             </a>
                         </div>
                     </form>
                 </div>

             </div>
         </div>
     </div>


     <style>
         .btn-color {
             background-color: #0d5ff8;
             color: #fff;

         }

         .profile-image-pic {
             height: 200px;
             width: 200px;
             object-fit: cover;
         }



         .cardbody-color {
            background-color : #ffffff  ;
            box-shadow: 0 6px 8px rgba(0,0,0,0.1);
             border-radius : 10px ;
             
         }

         a {
             text-decoration: none;
         }
     </style>
 

<?php require '../includes/footer.php' ?>
</body>