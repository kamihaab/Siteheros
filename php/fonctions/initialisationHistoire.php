<?php
session_start();
require_once("connect.php");
        if (isset($_GET['idhistoire'])) { 
            $idbranche=$_GET['idbranche'];
            $idhistoire=$_GET['idhistoire'];
            $requeteVieInitiale="SELECT histoire_vie FROM histoire WHERE histoire_id=$idhistoire"; //on prend la vie initiale de l'histoire
            $resVie=$bdd->query($requeteVieInitiale);
            $ligneVie=$resVie->fetch();
            $vieinitiale = $ligne['histoire_vie'];
            $requete = $bdd->prepare("INSERT INTO histoireEnCours (`histoireEnCours_vie`,`histoireEnCours_branche_id`) VALUES(?,?)"); 
            $requete->execute(array($vieinitiale,$idbranche));
            header('location: ../branche.php?id='.$idbranche);
            exit;

        }
    
?>