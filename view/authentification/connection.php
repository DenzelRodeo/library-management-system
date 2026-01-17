<?php
session_start();

// 1. Connexion DB
$host = 'localhost';
$dbname = 'biblio';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$erreur = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
      
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        // var_dump($user);

       
        if ($user && password_verify($password, $user['password'])) {
            // SUCCESS : On crée la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];

            // Redirection vers l'accueil
            header("Location: accueil.php");
            exit();
        } else {
            $erreur = "Identifiants incorrects.";
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
    <title>Connexion - Biblio 2</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #0866ff; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .error { color: red; background: #fee; padding: 10px; margin-bottom: 10px; border-radius: 4px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>biblio 2</h2>
        <?php if($erreur) echo "<div class='error'>$erreur</div>"; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>