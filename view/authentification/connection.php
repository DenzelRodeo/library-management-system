<?php
session_start();
$host = 'localhost'; $dbname = 'biblio'; $user = 'root'; $pass = '';

$erreur = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        
        $sql = "SELECT * FROM utilisateurs WHERE nom_utilisateur = :user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user' => $username]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data && password_verify($password, $user_data['mot_de_passe'])) {
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['user_nom'] = $user_data['nom_complet'];
            header("Location: ../../index.php");
            exit();
        } else {
            $erreur = "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        $erreur = "Erreur de base de données.";
    }
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
    <link href="../../css/biblio-2.css" rel="stylesheet">

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
                <h1 style="font-family: Arial, sans-serif; font-weight: bold;">Connection à Biblio</h1>
            </div>

            <div class="card my-5 border-0 shadow">
              <form id="loginForm" class="card-body p-lg-5 card-body-color" method="post" action="">
    
    <?php if ($erreur): ?>
        <div class="alert alert-danger text-center"><?= $erreur ?></div>
    <?php endif; ?>

    <div class="text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png"
             class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" 
             alt="logo-biblio">
    </div>

    <div class="mb-3">
        <label>Nom d'utilisateur</label>
        <input type="text" class="form-control" placeholder="Ex: admin" name="username" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" class="form-control" placeholder="Votre mot de passe" name="password" required>
    </div>
    <div class="text-center">
        <button type="submit" name="login_btn" class="btn btn-color px-5 mb-5 w-100">Se connecter</button>
    </div>

    <div class="form-text text-center text-dark">
        Nouveau ici ? <br>
        <a href="inscription.php" class="text-dark fw-bold" style="text-decoration:underline">Créer un compte</a>
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
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = this.querySelector('button');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion...';
        btn.disabled = true;
    });
</script>
<?php require '../includes/footer.php' ?>
</body>
