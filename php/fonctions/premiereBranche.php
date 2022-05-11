<?php
session_start();
if (isset($_GET['idhistoire']))
{
$idhistoire=$_GET['idhistoire'];

if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true&&isset($_GET['idbranche'])) {
require_once("connect.php");
    $idbranche=$_GET['idbranche'];
    $sql="UPDATE histoire
            SET histoire_branche_id='$idbranche'
            WHERE histoire_id='$idhistoire'";
            $bdd->query($sql);
            header('location: ../pageHistoireAdmin.php?id='.$idhistoire."#".$idbranche);
            exit;
}
 header('location: ../pageHistoireAdmin.php?id='.$idhistoire);
    exit;
}

else
{
    header('location: ../../index.php');
    exit;
}
?>