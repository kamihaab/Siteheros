<?php
require_once("connect.php");
$sql="DELETE FROM histoire WHERE histoire_titre=".'\''.addslashes($_GET['name']).'\'';
$bdd->query($sql);
header('location: ../index.php');
exit;
?>