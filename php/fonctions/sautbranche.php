<?php
session_start();


if (isset($_GET['idbrsv'])&&isset($_GET['idbractuelle'])) {
require_once("connect.php");

    $idbractuelle=$_GET['idbractuelle'];
    $idbranchesuivante=$_GET['idbrsv'];

    $requeteVie = "SELECT histoireEnCours_vie FROM histoireEnCours WHERE histoireEnCours_branche_id ='$idbractuelle'";
    $resVie = $bdd->query($requeteVie);

    $ligneVie = $resVie->fetch();

    $requete = "SELECT branche_vie FROM branche WHERE branche_id ='$idbranchesuivante'";
    $res = $bdd->query($requete);
    $ligne = $res->fetch();
    print_r($ligne);

    $wesh=$ligneVie['histoireEnCours_vie'];
    $wesh2=$ligne['branche_vie'];
    $vie = $ligneVie['histoireEnCours_vie'] - $ligne['branche_vie'];

    $sql = "UPDATE histoireEnCours
    SET histoireEnCours_vie='$vie',
    histoireEnCours_branche_id='$idbranchesuivante'
    WHERE histoireEnCours_branche_id ='$idbractuelle'";
    $bdd->query($sql);
    header('location: ../branche.php?id='.$idbranchesuivante);
    exit;
}

?>


