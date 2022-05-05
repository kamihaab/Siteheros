<?php
session_start();
if (isset($_GET['idhistoire']))
{
$idHistoire=$_GET['idhistoire'];

if (isset($_GET['idbranche'])&&isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
require_once("connect.php");
$idbranche=$_GET['idbranche'];
$sql="DELETE FROM branche WHERE branche_id='$idbranche'";
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
