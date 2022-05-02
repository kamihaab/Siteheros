<?php
require_once("connect.php");
$sql="INSERT INTO user (usr_login,usr_password) VALUES (?,?)";
$insertion=$bdd->prepare($sql);
$insertion->execute(array("login","password"));
header("Location: index.php");
exit;
?>