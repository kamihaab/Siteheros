<?php
session_start();
if (isset($_GET['id'])&&isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
require_once("connect.php");
$id=$_GET['id'];
$sql="DELETE FROM histoire WHERE histoire_id='$id'";
$bdd->query($sql);
}
header('location: ../../index.php');
exit;
?>
