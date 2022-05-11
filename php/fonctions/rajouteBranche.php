<?php
session_start();
if (isset($_GET['idhistoire']))
{
$idHistoire=$_GET['idhistoire'];

if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
require_once("connect.php");

$sql="SELECT Count(*) as total FROM branche WHERE branche_histoire_id=$idHistoire";
$res=$bdd-> query($sql);
$ligne=$res->fetch();   
$nextId=($ligne['total']+1);
$titrebranche='branche '.$nextId;
$sql="INSERT INTO branche (branche_histoire_id,branche_titre) VALUES ($idHistoire,'$titrebranche')";
$bdd->query($sql);
$lastid=$bdd->lastInsertId();
if (isset($_GET['idbranchesuivante']))
{
    $idbranchesuivante=$_GET['idbranchesuivante'];

    $sql="INSERT INTO brancheabranche (brancheabranche_brancheactuelle_id,brancheabranche_branchesuivante_id) VALUES ($lastid,$idbranchesuivante)";
    $bdd->query($sql);
    
}
if (isset($_GET['idbrancheprecedente']))
{
    $idbrancheprecedente=$_GET['idbrancheprecedente'];

    $sql="INSERT INTO brancheabranche (brancheabranche_brancheactuelle_id,brancheabranche_branchesuivante_id) VALUES ($idbrancheprecedente,$lastid)";
    $bdd->query($sql);
}
header('location: ../pageHistoireAdmin.php?id='.$idHistoire.'#anchora');
exit;

}
else{
header('location: ../pageHistoire.php?id='.$idHistoire);
exit;
}
}

else
{
    header('location: ../../index.php');
    exit;
}
