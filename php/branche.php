<?php
require_once('fonctions/connect.php');
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <title> Le Site dont tu es le Héros</title>
</head>

<body>
<?php include "Header.php"?>
    <main>
        <?php if (isset($_GET['id']))
        {
            $sql="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            $res=$bdd->query($sql);
            $ligne=$res->fetch();

            $images=glob("../images/".$ligne['branche_image'].'.{jpg,png}',GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['branche_titre'];
            $paragraphe=$ligne['branche_paragraphe'];

            ////////////////////////////////////////////////
            $histoire=$ligne['branche_histoire_id']; //on recupère l'histoire associée à la branche
            $requeteVieInitiale="SELECT histoire_vie FROM histoire WHERE histoire_branche_id ='$histoire'"; //on prend la vie initiale de l'histoire
            $res=$bdd->query($requeteVieInitiale);
            $ligne=$res->fetch();
            $vieinitiale = $ligne['histoire_vie'];
            $vie;
            //On regarde si la table histoire en cours est vide 
            $reqCheck ="SELECT histoireEnCours_vie FROM histoireEnCours"; //Where avec le user_id??
            if(empty($reqCheck)){
                $vie=$vieinitiale;
                $requete = $bdd->prepare("INSERT INTO histoireEnCours (`histoireEnCours_vie`) VALUES(?)"); 
                $requete->execute(array($vie));

            }
            else{
                $requeteVie="SELECT histoireEnCours_vie FROM histoireEnCours WHERE histoireEnCours_branche_id ='$_GET[id]'";
                $res=$bdd->query($requeteVie);
                $ligne=$res->fetch();
                $vie=$ligne['histoireEnCours_vie']- $ligne['branche_vie'];
                //On va maintenant enregistrer la variable vie dans la table histoire en cours associée au user_id
            //$requeteUser="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            //$_SESSION['login']
                $sql = "UPDATE histoireEnCours
                SET histoireEnCours_vie='$vie'
                WHERE histoireEnCours_branche_id ='$_GET[id]'";
                $bdd->query($sql);



            }
            /*Ancienne technique
            if ($ligne['branche_id']!=='2'){
                $vie=$ligne['histoireEnCours_vie'] - $ligne['branche_vie'];
                //vieencours dans histoire en cours 
                //vie initiale dans histoire pour laisser le mec choisir

            }
            if ($ligne['branche_id']==='2'){
                $vie=$vieinitiale - $ligne['branche_vie'];
            }
            */
          //////////////////////////////////////////////////////////////////////////////////////
            ?>

            <img class="FondBranche" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
            <h2><?=$titre?></h2>
            <br><br><br><br><br>
            <p><?=$paragraphe?></p>
            <br><br><br>
            <!-- On ajoute la vie -->
            <p>
            <img class="pv" src="../image/vie.png" alt="image coeur">
            <?=$vie?></p>
            <br><br><br>
            <!---->
            <?php
        $sql = "SELECT * FROM brancheabranche WHERE brancheabranche_brancheactuelle_id ='$_GET[id]'"; //ou =branche_id? 
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
        ?>
            <a class="bouton choix" href="branche.php?id=<?= $ligne['brancheabranche_branchesuivante_id'] ?>" > <?= $ligne['brancheabranche_nombouton'] ?></a> 
            
            <?php
        }
        
        }
        ?>
    </main>




</body>

</html>