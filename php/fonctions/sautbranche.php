<?php
session_start();


if (isset($_GET['idbrsv'])&&isset($_GET['idhist'])) {
require_once("connect.php");

    $idhistoire=$_GET['idhist'];
    $idbranchesuivante=$_GET['idbrsv'];
    $sql ="UPDATE histoireEnCours
    SET histoireEnCours_branche_id='$idbranchesuivante'
    WHERE histoireEnCours_branche_id ='$idhistoire'";
    $bdd->query($sql);
    header('location: ../branche.php?id='.$idbranchesuivante);
    exit;
}

?>


