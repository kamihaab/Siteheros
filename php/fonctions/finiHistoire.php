<?php

function finiHistoire($bdd,$idUser,$idhistoire,$aReussi)
{
    $sql="DELETE FROM histoireEnCours 
                WHERE histoireEnCours_usr_id='$idUser'
                AND histoireEnCours_branche_id IN
                (SELECT branche_id FROM branche WHERE branche_histoire_id='$idhistoire')";
    $bdd->query($sql);

    if ($aReussi)
    {
        $sql="SELECT histoire_nombre_reussite FROM histoire WHERE  histoire_id='$idhistoire'";
        $res=$bdd->query($sql);
        $nombrereussite=$res->fetch();
        $nbrereus=$nombrereussite['histoire_nombre_reussite']+1;

        $sql="UPDATE histoire
        SET histoire_nombre_reussite='$nbrereus'
        WHERE histoire_id='$idhistoire'";
        $bdd->query($sql);
    }
}
?>