<?php

$user = 'root' ; $host = 'localhost'; $db = 'biblio' ; $password = '';

try {

   $pdo = new PDO("mysql:host = $host ; dbname = $db ",$user , $password );
   $pdo -> setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
   $sql = 'SELECT * FROM etudiant';
   $stmt = $pdo->query($sql);

   $etudiant = $stmt->fetchAll(PDO::ASSOC);

   var_dump($etudiant);

} catch (Exception $e) {

    die('Erreur !'.$e->getMessage());
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

    <title>Biblio 2 - Inscription</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/biblio-2.css" rel="stylesheet">

</head>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<body style = " background-color: #f2f4f6;">
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
</nav>
       <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a class="sidebar-brand d-flex align-items-center justify-content-center mt-5" href="../../index.php" style="font-size: 30px; font-family: 'Times New Roman'; color: #009879; text-decoration: none;">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Biblio <sup>2</sup></div>
            </a>

            <div class="text-center mt-3 mb-2 text-dark">
                <h1 style="font-family: Arial, sans-serif; font-weight: bold;">Création de compte</h1>
            </div>

            <div class="card my-5 border-0 shadow">
                <form id="registerForm" class="card-body p-lg-5 card-body-color" method="post" action="#">
                    <div class="text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png"
                             class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" 
                             alt="logo-biblio">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Nom" name="username" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="prenom" placeholder="Prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="email" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="email" placeholder="classe" name="email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password1" placeholder="Mot de passe" name="password1" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password2" placeholder="Confirmation du mot de passe" name="password2" required>
                        <div id="passError" class="error-msg">Les mots de passe ne sont pas identiques.</div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-color px-5 mb-5 w-100">Créer mon compte</button>
                    </div>

                    <div class="form-text text-center text-dark">
                        Avez-vous déjà un compte ? <br>
                        <a href="view/authentification/connection.php" class="text-dark fw-bold" style="text-decoration:underline">Connectez-vous</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

     <style>
         .btn-color {
             background-color: #1b61e2;
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
         <>
    body {
        background-color: #f8f9fc;
    }
    .card-body-color {
        background-color: #ebf2f1; /* Fond très légèrement teinté */
    }
    .btn-color {
        background-color: #009879;
        color: white;
        transition: 0.3s;
    }
    .btn-color:hover {
        background-color: #007d63;
        color: white;
    }
    .profile-image-pic {
        height: 150px;
        width: 150px;
        object-fit: cover;
    }
    .form-control:focus {
        border-color: #009879;
        box-shadow: 0 0 0 0.2rem rgba(0, 152, 121, 0.25);
    }
    .error-msg {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
        display: none;
    }
    </style>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
    let isValid = true;

    // 1. Éléments
    const email = document.getElementById('email');
    const pass1 = document.getElementById('password1');
    const pass2 = document.getElementById('password2');
    
    const emailError = document.getElementById('emailError');
    const passError = document.getElementById('passError');

    // 2. Regex Email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validation Email
    if (!emailRegex.test(email.value)) {
        emailError.style.display = 'block';
        email.style.borderColor = '#e74c3c';
        isValid = false;
    } else {
        emailError.style.display = 'none';
        email.style.borderColor = '#ddd';
    }

    // Validation Mots de passe
    if (pass1.value !== pass2.value) {
        passError.style.display = 'block';
        pass2.style.borderColor = '#e74c3c';
        isValid = false;
    } else {
        passError.style.display = 'none';
        pass2.style.borderColor = '#ddd';
    }

    // Empêcher l'envoi si invalide
    if (!isValid) {
        e.preventDefault();
    }
 });
</script>        
<?php require '../includes/footer.php' ?>
</body>
