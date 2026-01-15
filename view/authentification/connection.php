<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Validation LinkedIn</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
    * {
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  margin: 0;
  height: 100vh;
  background: #f3f6f8;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  width: 100%;
  max-width: 420px;
}

.card {
  background: #ffffff;
  padding: 30px 25px;
  border-radius: 10px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  text-align: center;
}

.icon {
  font-size: 40px;
  margin-bottom: 15px;
}

h2 {
  font-size: 22px;
  margin-bottom: 15px;
  color: #000;
}

.description {
  font-size: 14px;
  color: #555;
  line-height: 1.5;
  margin-bottom: 20px;
}

.checkbox {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  color: #333;
  margin-bottom: 25px;
  text-align: left;
}

.checkbox input {
  accent-color: #0a66c2;
}

.btn-primary {
  width: 100%;
  padding: 12px;
  background: #ffffff;
  color: #0a66c2;
  border: 2px solid #0a66c2;
  border-radius: 30px;
  font-size: 15px;
  cursor: pointer;
  margin-bottom: 20px;
  transition: 0.3s;
}

.btn-primary:hover {
  background: #0a66c2;
  color: #ffffff;
}

.link {
  font-size: 14px;
  color: #0a66c2;
  text-decoration: none;
}

.link:hover {
  text-decoration: underline;
}

</style>
<body>

  <div class="container">
    <div class="card" style = "display = flex ; flex-direction:colum">

      <div class="icon">
        📱
      </div>

      <h2>Administrer votre compte<strong> Biblio 2</strong></h2>

      <p class="description">
     Nous avons developper ce logiciel pour vous faciliter
     la gestion de votre bibliotheque. Acceder a votre compte
     et sentez vous comme chez vous . 
      </p>

      <div class="row">
        <label>Name</label><br>
        <input type="text" class = "form-control form-control-user" placeholder = "Admin name">
      </div>
       <div class = "row">
        <label>Email</label><br>
        <input type="email" class = "form-control form-control-user" placeholder = "Exemple@gmail.com">
       </div>
       <div class = "row">
         <label>Password</label><br>
         <input type="text" class = "form-control form-control-user" placeholder  = "vous recevrez um mot de passe">
       </div>
        <div class = "row">
           <button class="btn-primary">Connection</button>
        </div>
    
      <a href="#" class="link">Je n’ai pas accès à mon compte</a>

    </div>
  </div>
</body>
</html>
