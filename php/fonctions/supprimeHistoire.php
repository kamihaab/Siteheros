<?php
require_once("connect.php");
$id=$_GET['id'];
$sql="DELETE FROM histoire WHERE histoire_id='$id'";
$bdd->query($sql);
header('location: ../index.php');
exit;
?>