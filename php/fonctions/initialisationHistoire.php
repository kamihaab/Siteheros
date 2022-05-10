<?php
session_start();
require_once("connect.php");

        if (isset($_SESSION['iduser'])&&isset($_GET['idhistoire'])&&isset($_GET['idbranche'])) {
            $idbranche=$_GET['idbranche'];
            $idhistoire=$_GET['idhistoire'];
            $requeteVieInitiale="SELECT histoire_vie,histoire_nombre_essai FROM histoire WHERE histoire_id='$idhistoire'"; //on prend la vie initiale de l'histoire
            $resVie=$bdd->query($requeteVieInitiale);
            $ligneVie=$resVie->fetch();

            $idUser=$_SESSION['iduser'];
            $vieinitiale = $ligneVie['histoire_vie'];
            $nombre_essai=$ligneVie['histoire_nombre_essai']+1;
          
            if (isset($_GET['recommence'])&&$_GET['recommence']="true")
            {
                require("finiHistoire.php");
                finiHistoire($bdd,$idUser,$idhistoire,false);
            }

            $requete = $bdd->prepare("INSERT INTO histoireEnCours (`histoireEnCours_usr_id`,`histoireEnCours_vie`,`histoireEnCours_branche_id`) VALUES(?,?,?)"); 
            $requete->execute(array($idUser,$vieinitiale,$idbranche));

            $sql="UPDATE histoire
            SET histoire_nombre_essai='$nombre_essai'
            WHERE histoire_id='$idhistoire'";
            $bdd->query($sql);

            header('location: ../branche.php?id='.$idbranche);
            exit;

        }
        else{
            header('location: ../index.php');
            exit;
        }
    
?>