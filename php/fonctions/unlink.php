<?php
session_start();
if (isset($_GET['idhistoire']))
{
$idHistoire=$_GET['idhistoire'];

if (isset($_GET['idbrancheprecedente'])&&isset($_GET['idbrancheactuelle'])&&isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
require_once("connect.php");

$idbrancheactuelle=$_GET['idbrancheactuelle'];
$idbrancheprecedente=$_GET['idbrancheprecedente'];

$sql="DELETE FROM brancheabranche WHERE brancheabranche_brancheactuelle_id='$idbrancheprecedente' AND brancheabranche_branchesuivante_id='$idbrancheactuelle'";
$bdd->query($sql);
}
header('location: ../pageHistoireAdmin.php?id='.$idHistoire);
exit;
}
else
{
    header('location: ../index.php');
    exit;
}
?>