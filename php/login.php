<?php
require_once "fonctions/connect.php";
session_start();

if (!empty($_POST['login']) and !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $stmt = $bdd->query("select * from user where usr_login='$login'");
    while($row=$stmt->fetch()) {
        // Authentication successful

        if (password_verify($password,$row['usr_password'])){
        $_SESSION['iduser'] =$row['usr_id'];
        $_SESSION['login'] = $login;
        $_SESSION['loggedin'] = true;
        $_SESSION['estAdmin'] =$row['usr_estAdmin'];
        header('Location: ../index.php');
        exit;
        }
    }
    $error = "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
}
?><html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style stylelogin-->
        <link rel="stylesheet" href="../css/stylelogin.css"/>
    </head>
    <body>
        <div class="container">
            <!-- zone de connexion -->
            
            <form action="login.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' class="submit" value='SE CONNECTER' >

                <label><b>Vous n'avez pas de compte? Inscrivez-vous en cliquant </b></label>
                <a href="inscription.php"> ici </a>
                
                <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $error ?>
            </div>
        <?php } ?>
            </form>
        </div>
    </body>
</html>