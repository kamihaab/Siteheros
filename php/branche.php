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
    <?php include "Header.php" ?>
    <main>
        <?php if (isset($_GET['id'])) {
            $idbranche = $_GET['id'];
            $sql = "SELECT * FROM branche WHERE branche_id='$idbranche'";
            $res = $bdd->query($sql);
            $ligne = $res->fetch();

            $images = glob("../images/" . $ligne['branche_image'] . '.{jpg,png}', GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['branche_titre'];
            $paragraphe = $ligne['branche_paragraphe'];
            $idhistoire=$ligne['branche_histoire_id'];

            ////////////////////////////////////////////////
            
            $requeteVie = "SELECT histoireEnCours_vie FROM histoireEnCours WHERE histoireEnCours_branche_id ='$idbranche'";
            $resVie = $bdd->query($requeteVie);
            $ligneVie = $resVie->fetch();
            //print_r($ligneVie);
            $vie = $ligneVie['histoireEnCours_vie'] - $ligne['branche_vie'];
            //On va maintenant enregistrer la variable vie dans la table histoire en cours associée au user_id
            //$requeteUser="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            //$_SESSION['login']
            $sql = "UPDATE histoireEnCours
                SET histoireEnCours_vie='$vie'
                WHERE histoireEnCours_branche_id ='$idbranche'";
            $bdd->query($sql);




        }
       
        //////////////////////////////////////////////////////////////////////////////////////
        ?>

        <img class="FondBranche" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
        <h2><?= $titre ?></h2>
        <br><br><br><br><br>
        <p><?= $paragraphe ?></p>
        <br><br><br>
        <!-- On ajoute la vie -->
        <p>
            <img class="pv" src="../images/vie.png" alt="image coeur">
            <?= $vie ?>
        </p>
        <br><br><br>

        <!---->
        <?php
        
        $sql = "SELECT * FROM brancheabranche WHERE brancheabranche_brancheactuelle_id ='$_GET[id]'"; //ou =branche_id? 
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
            $idbranchesuivante=$ligne['brancheabranche_branchesuivante_id'];
        ?>

            <a class="bouton choix" href="fonctions/sautbranche.php?idbrsv=<?=$idbranchesuivante?>&idhist=<?=$idhistoire?>"> <?= $ligne['brancheabranche_nombouton'] ?></a>

        <?php
        }
        

        if ($vie<=0){
            ?>
            <p> 
        <img src="../images/perdu.gif" alt="c'est perdu">
        </br>
            Vous avez perdu ! 
    </p> <a class="bouton choix" href="index.php"> Retourner à la page d'accueil </a>;
    <?php
        }
        if(empty($idbranchesuivante) && ($vie>0)){
            ?>
            <p> 
            <img src="../images/gagne.gif" alt="c'est gagné">
            </br>
                Vous avez gagné ! 
            </p> <a class="bouton choix" href="index.php"> Tenter de gagner une autre histoire! </a>
            <?php
        }

    


        ?>
    </main>




</body>

</html>