<?php
session_start();
require_once("connect.php");
if (isset($_GET['idhistoire']))
{
$idHistoire=$_GET['idhistoire'];

    if (isset($_GET['idbranche']) && isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] = true)
    {
    $idbranche=$_GET['idbranche'];

    if (isset($_POST['titrebranche']))
    {  
        $titre=$_POST['titrebranche'];
        $sql = "UPDATE branche
                    SET branche_titre='$titre'
                    WHERE branche_id='$idbranche'";

        $bdd->query($sql);
    }
    header('location: ../pageHistoireAdmin.php?id='.$idHistoire.'#'.$idbranche);
    exit;
    }
    header('location: ../pageHistoireAdmin.php?id='.$idHistoire);
    exit;
}
?>