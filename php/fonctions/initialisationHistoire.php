<?php
session_start();
require_once("connect.php");

        if (isset($_SESSION['iduser'])&&isset($_GET['idhistoire'])&&isset($_GET['idbranche'])) { 
            $idbranche=$_GET['idbranche'];
            $idhistoire=$_GET['idhistoire'];
            $requeteVieInitiale="SELECT histoire_vie FROM histoire WHERE histoire_id='$idhistoire'"; //on prend la vie initiale de l'histoire
            $resVie=$bdd->query($requeteVieInitiale);
            $ligneVie=$resVie->fetch();
            print_r($ligneVie);
            $idUser=$_SESSION['iduser'];
            $vieinitiale = $ligneVie['histoire_vie'];
            $requete = $bdd->prepare("INSERT INTO histoireEnCours (`histoireEnCours_usr_id`,`histoireEnCours_vie`,`histoireEnCours_branche_id`) VALUES(?,?,?)"); 
            $requete->execute(array($idUser,$vieinitiale,$idbranche));
            header('location: ../branche.php?id='.$idbranche);
            exit;

        }
        else{
            header('location: ../index.php');
            exit;
        }
    
?>