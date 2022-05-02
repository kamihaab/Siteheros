<?php //Inscription php : vérification des données entrées 
require_once "../sql/connexionBDD.php";
session_start();
//include('../sql/connexionBDD.php'); //je sais pas si c'est nécessaire 
// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }
 
  // On regarde s'il ya des données dans la variable "$_Post" 
  if(!empty($_POST)){
    extract($_POST);
    $valid = true;
 
    //On récupère les différentes données
    if (isset($_POST['inscription'])){
      $name  = htmlentities(trim($name)); // On récupère le nom
      $surname = htmlentities(trim($surname)); // on récupère le prénom
      $username = htmlentities(trim($username));
      $password = trim($password); // On récupère le mot de passe 
      $confmdp = trim($confpassword); // On récupère la confirmation du mot de passe
 
      // Vérification du nom
      if(empty($name)){
        $valid = false;
        $erreur = ("Il faut entrer un nom d'utilisateur!");
      }   
 
      // Vérification du prénom
      if(empty($surname)){
        $valid = false;
        $erreur = ("Il faut entrer votre prénom!");
      } 
      
      // Vérification du nom d'utilisateur
      if(empty($username)){
        $valid = false;
        $erreur = ("Il faut entrer votre nom d'utilisateur!");
      } 


 
      // Vérification du mot de passe
      if(empty($password)) {
        $valid = false;
        $erreur = "Le mot de passe ne peut pas être vide";
 
      }
      elseif($password != $confpassword){
        $valid = false;
        $erreur = "Votre mot de passe ne correspond pas";
      }
 
      // Si "valid" est bien true, on peut procéder au traitement 
      if($valid){
        //On hâche le mot de passe
        $password = crypt($password, "$6$rounds=5000$macleapersonnaliseretagardersecret$"); //le fameux hachage de mot de passe
 
        // On insert nos données dans la table user (Pour les admin faire un if si jamais ils ont coché admin?)
        $DB->insert("INSERT INTO user (usr_login, usr_password) VALUES (?, ?)", array($username,$password));
        header('Location: index.php');
        exit;
      }
    }
  }
?>
<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style stylelogin-->
        <link rel="stylesheet" href="../css/stylelogin.css"/>
    </head>
    <body>
        <div class="container"><!--inscription html-->
         <form action="verification.php" name="inscription" method="POST">
                <h1>Inscription</h1>

                <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $error ?>
            </div> <?php } ?>

                <label><b>Nom </b></label>
                <input type="text" placeholder="Entrer votre nom" name="name" required>

                <label><b>Nom </b></label>
                <input type="text" placeholder="Entrer votre prénom" name="surname" required>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <label><b>Confirmation du mot de passe</b></label>
                <input type="password" placeholder="Confirmer le mot de passe" name="confpassword" required>

                <input type="submit" id='submit' class="submit" value='SINSCRIRE' >
            </form>
        </div>
    </body>
</html>