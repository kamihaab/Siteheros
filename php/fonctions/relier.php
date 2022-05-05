<?php
session_start();
if (isset($_GET['idhistoire']))
{
$idHistoire=$_GET['idhistoire'];
if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
require_once("connect.php");

if (isset($_GET['idbrancheactuelle'])&&isset($_GET['idbranchesuivante']))
{

    $idbranchesuivante=$_GET['idbranchesuivante'];
    $idbrancheactuelle=$_GET['idbrancheactuelle'];

    $sql="INSERT INTO brancheabranche (brancheabranche_brancheactuelle_id,brancheabranche_branchesuivante_id) VALUES ($idbrancheactuelle,$idbranchesuivante)";
    $bdd->query($sql);
}

}
header('location: ../pageHistoireAdmin.php?id='.$idHistoire);
exit;
}

else
{
    header('location: ../index.php');
    exit;
}
