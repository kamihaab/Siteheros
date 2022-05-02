<?php //Inscription php : vérification des données entrées 
require_once "../html/connect.php";
session_start();
//include('../sql/connexionBDD.php'); //je sais pas si c'est nécessaire 
// S'il y a une session alors on ne retourne plus sur cette page
/*if (isset($_SESSION['id'])){
    header('Location: ../html/index.php');
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
      
      /*

      $name  = htmlentities(trim($name)); // On récupère le nom
      $surname = htmlentities(trim($surname)); // on récupère le prénom
      $username = htmlentities(trim($username));
      $password = trim($password); // On récupère le mot de passe 
      $confpassword = trim($confpassword); // On récupère la confirmation du mot de passe
      $valid = true;
      */
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
        //On hâche le mot de passe
        //$password = crypt($password, "$6$rounds=5000$macleapersonnaliseretagardersecret$"); //le fameux hachage de mot de passe
        // On insert nos données dans la table user (Pour les admin faire un if si jamais ils ont coché admin?)
        $requete = $bdd->prepare("INSERT INTO user (`usr_login`, `usr_password`,`usr_estAdmin`) VALUES(?, ?, ?)"); 
        
        $requete->execute(array($username,$password, $admin));
        //var_dump($requete);
        header('Location: ../html/index.php');
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