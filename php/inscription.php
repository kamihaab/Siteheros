<?php //Inscription php : vérification des données entrées 
require_once "../php/fonctions/connect.php";
session_start();
//include('../sql/connexionBDD.php'); //je sais pas si c'est nécessaire 
// S'il y a une session alors on ne retourne plus sur cette page
/*if (isset($_SESSION['id'])){
    header('Location: ../html/../index.php');
    exit;
  }
  */
 
  // On regarde s'il ya des données dans la variable "$_Post" 
  //if(!empty($_POST)){
    $valid = true;
 
    //On récupère les différentes données
    
      //echo("PORBLEME");
      if (isset($_POST["name"])){
      $name= $_POST["name"];
      
      $surname= $_POST["surname"];
      $username= $_POST["username"];
      $password= $_POST["password"];
      $confpassword=$_POST["confpassword"];
      $admin='0';
      if (isset($_POST["admin"])){
        $admin = true;
      }
      
      

      
 
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
        $password=password_hash($password, PASSWORD_BCRYPT);
        //On hâche le mot de passe
        $requete = $bdd->prepare("INSERT INTO user (`usr_login`, `usr_password`,`usr_estAdmin`) VALUES(?, ?, ?)"); 
        
        $requete->execute(array($username,$password, $admin));
        header('Location: ../php/../index.php');
        exit;
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
         <form action="inscription.php" name="inscription" method="POST">
                <h1>Inscription</h1>

                <?php if (isset($erreur)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $erreur ?>
            </div> <?php } ?>

                <label><b>Nom </b></label>
                <input type="text" placeholder="Entrer votre nom" name="name" >

                <label><b>Prénom </b></label>
                <input type="text" placeholder="Entrer votre prénom" name="surname" required>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <label><b>Confirmation du mot de passe</b></label>
                <input type="password" placeholder="Confirmer le mot de passe" name="confpassword" required>

                <label><b>Vous êtes administrateur</b></label>
                <input type="checkbox" value="true" placeholder="Administrateur" name="admin">

                <input type="submit" id='submit' class="submit" value='SINSCRIRE' >
            </form>
        </div>
    </body>
</html>