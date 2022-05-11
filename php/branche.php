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
            if (count($images)>0)
            {
            $nomImage = $images[0];
            }
            $titre = $ligne['branche_titre'];
            $paragraphe = $ligne['branche_paragraphe'];
            $idhistoire=$ligne['branche_histoire_id'];
            $iduser=$_SESSION['iduser'];
            ////////////////////////////////////////////////
            
            $requeteVie = "SELECT histoireEnCours_vie,histoireEnCours_filAriane FROM histoireEnCours WHERE histoireEnCours_branche_id ='$idbranche' AND histoireEnCours_usr_id='$iduser'";
            $resVie = $bdd->query($requeteVie);
            $ligneVie = $resVie->fetch();
            $vie = $ligneVie['histoireEnCours_vie'];
            $filAriane=$ligneVie['histoireEnCours_filAriane'];
            $mot="(".$filAriane.")";
            $sql="SELECT branche_titre FROM branche WHERE branche_id IN $mot";
            $res=$bdd->query($sql);
            echo "<h4>";
            echo "Votre fil d'Ariane:";
            while($ligne=$res->fetch())
            {
                echo $ligne['branche_titre'].">";
            }
            echo $titre;
            echo "</h4>";


            //On va maintenant enregistrer la variable vie dans la table histoire en cours associée au user_id
            //$requeteUser="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            //$_SESSION['login']
        }
        
        //////////////////////////////////////////////////////////////////////////////////////
        if (count($images)>0)
        {
            ?>
            <img class="FondBranche" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">

            <?php
        }
        
         ?>
         <br><br><br>
         <p><?=$titre?></p>
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

            <a class="bouton choix" href="fonctions/sautbranche.php?idbrsv=<?=$idbranchesuivante?>&idbractuelle=<?=$idbranche?>"> <?= $ligne['brancheabranche_nombouton'] ?></a>

        <?php
        }
        

        if ($vie<=0){
            require("fonctions/finiHistoire.php");
            finiHistoire($bdd,$iduser,$idhistoire,false);
            ?>
            <p> 
        <img src="../images/perdu.gif" alt="c'est perdu">
        </br>
            Vous avez perdu ! 
            
    </p> <a class="bouton choix" href="index.php"> Retourner à la page d'accueil </a>;
    <?php //Faire un redirect vers initialisé histoire ou créer réinitialiser histoire pour remettre les compteurs a zéro?
        }
        if(empty($idbranchesuivante) && ($vie>0)){
            require("fonctions/finiHistoire.php");
            finiHistoire($bdd,$iduser,$idhistoire,true);
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