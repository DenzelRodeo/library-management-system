<?php
$host = 'localhost'; $dbname = 'biblio'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) { die("Erreur : " . $e->getMessage()); }

$message = "";
$type_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($nom) && !empty($email) && !empty($password)) {
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $check->execute([$email]);
        
        if ($check->rowCount() > 0) {
            $message = "Cet email est déjà utilisé.";
            $type_message = "error";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)");
            if ($ins->execute([$nom, $email, $password_hash])) {
                $message = "Inscription réussie ! Vous pouvez vous connecter.";
                $type_message = "success";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Biblio</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 350px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #42b72a; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .message { padding: 10px; margin-bottom: 10px; border-radius: 4px; font-size: 14px; text-align: center; }
        .error { color: red; background: #fee; }
        .success { color: green; background: #efe; }
        .back-link { display: block; text-align: center; margin-top: 15px; font-size: 14px; color: #0866ff; text-decoration: none; }
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
        <h2 style="text-align:center">Inscription</h2>
        
        <?php if($message): ?>
            <div class="message <?php echo $type_message; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Choisir un mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>

        <a href="../../index.php" class="back-link">Déjà inscrit ? Connectez-vous</a>
    </div>
</body>
</html>