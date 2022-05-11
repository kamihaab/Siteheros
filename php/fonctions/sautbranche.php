<?php
session_start();


if (isset($_GET['idbrsv'])&&isset($_GET['idbractuelle'])) {
require_once("connect.php");

    $idbractuelle=$_GET['idbractuelle'];
    $idbranchesuivante=$_GET['idbrsv'];

    $requeteVie = "SELECT histoireEnCours_vie,histoireEnCours_filAriane FROM histoireEnCours WHERE histoireEnCours_branche_id ='$idbractuelle'";
    $resVie = $bdd->query($requeteVie);

    $ligneVie = $resVie->fetch();

    $requete = "SELECT branche_vie FROM branche WHERE branche_id ='$idbranchesuivante'";
    $res = $bdd->query($requete);
    $ligne = $res->fetch();


    $vie = $ligneVie['histoireEnCours_vie'] - $ligne['branche_vie'];
    $filAriane=$ligneVie['histoireEnCours_filAriane'].",".$idbractuelle;
    $sql = "UPDATE histoireEnCours
    SET histoireEnCours_vie='$vie',
    histoireEnCours_branche_id='$idbranchesuivante',
    histoireEnCours_filAriane='$filAriane'
    WHERE histoireEnCours_branche_id ='$idbractuelle'";
    $bdd->query($sql);
    header('location: ../branche.php?id='.$idbranchesuivante);
    exit;
}

?>


