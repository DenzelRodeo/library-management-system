<?php
session_start();

$host = 'localhost'; $dbname = 'biblio'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { die("Erreur : " . $e->getMessage()); }

$erreur = "";
$email_saisi = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_saisi = trim($_POST['email']); 
    $password = $_POST['password'];

    if (!empty($email_saisi) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email_saisi]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];
            header("Location: home.php");
            exit();
        } else {
            $erreur = "Informations incorrectes.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Biblio</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .btn-login { width: 100%; padding: 12px; background: #0866ff; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; margin-bottom: 10px; }
        .btn-register { display: block; text-decoration: none; width: 100%; padding: 10px; background: #42b72a; color: white; border-radius: 6px; font-weight: bold; font-size: 14px; box-sizing: border-box; }
        .error { color: red; background: #fee; padding: 10px; margin-bottom: 10px; border-radius: 4px; font-size: 14px; }
        hr { border: 0; border-top: 1px solid #ddd; margin: 20px 0; }
        .logo-container {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
       }
      .logo-container svg {
       filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.1));
       }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo-container">
    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="11" fill="#0866ff"/>
        <path d="M6.5 17.5L10.5 15.5V5.5L6.5 7.5V17.5Z" fill="white"/>
        <path d="M17.5 17.5L13.5 15.5V5.5L17.5 7.5V17.5Z" fill="#e0e0e0"/>
        <path d="M11 10.5C11 9.67157 11.6716 9 12.5 9C13.3284 9 14 9.67157 14 10.5C14 11.1 13.7 11.5 13 12L11 14V15H14" 
              stroke="#0866ff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <h1 style="margin: 10px 0 0 0; color: #0866ff; font-size: 24px;">Biblio 2</h1>
</div>
        <h2>Connexion</h2>
        <?php if($erreur) echo "<div class='error'>$erreur</div>"; ?>
        
        <form method="POST" action ="index.php">
            <input type="email" name="email" placeholder="Adresse e-mail" value="<?php echo htmlspecialchars($email_saisi); ?>" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <hr>
        <a href="view/authentification/inscription.php" class="btn-register">Créer un nouveau compte</a>
    </div>
</body>
</html>