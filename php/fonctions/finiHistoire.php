<?php

function finiHistoire($bdd,$idUser,$idhistoire)
{
    $sql="DELETE FROM histoireEnCours 
                WHERE histoireEnCours_usr_id='$idUser'
                AND histoireEnCours_branche_id IN
                (SELECT branche_id FROM branche WHERE branche_histoire_id='$idhistoire')";
    $bdd->query($sql);
}
?>