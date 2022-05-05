

<?php
/*
//on teste la présence de la variable de %age que l'on attribue du GET à une variable fixe.
if(isset($_GET['pc']))
	{
	$pc=$_GET['pc'];
	}
//on teste la présence de la variable de type que l'on attribue du GET à une variable fixe.
if(isset($_GET['type']))
	{
	$type=$_GET['type'];
//on crée un switch ayant pour but de vérifier quel est le type de barre et d'en changer les proportions en fonction du type désiré.
		switch ($type)
		{
//ici il n'y a qu'un seul cas, mais d'autres viendront.
		case "normal":
		$long=250;
		$haut=20;
		break;
		}
	}
//on teste la présence de la variable de couleur que l'on attribue du GET à une variable fixe.
if(isset($_GET['color']))
	{
	$color=$_GET['color'];
//encore une fois : un switch, qui permettra de changer la couleur de la barre.
		switch ($color)
		{
//la variable color contient un "nom" de couleur, la couleur n'étant pas en héxa mais en RGB, on crée selon le contenu de color trois variables qui emporteront les R, G, et B de chaque cas.
		case "rouge":
		$color1=184;
		$color2=46;
		$color3=33;
		break;
		
		case "vert":
		$color1=48;
		$color2=166;
		$color3=1;
		break;
		}
	}
//ici on retrouve les commandes GD relatives à la création d'une image.
     header ("Content-type: image/png");
//on crée une image dont la taille varie selon le case switch plus haut.
     $image = imagecreate($long,$haut);
//on calcule le %age afin de calibrer la longueur réelle de la barre, par rapport à la taille totale de la barre.
     $pv=($pc*$long)/100;

//phase d'attribution des couleurs, la première est celle du fond.
     $blanc=imagecolorallocate($image, 255, 255, 255);
     $noir=imagecolorallocate($image, 0, 0, 0);

//on crée la variable "fond" qui accueille les trois couleurs via les trois variables définies sur le case switch color, plus haut.
     $fond=imagecolorallocate($image, $color1, $color2, $color3);
//puis on crée le fond en lui même dont la couleur sera celle définit juste au dessus.
     imageFilledRectangle($image, 0, 0, $pv, 20, $fond);

//on écrit le contenu de la variable pc, ici concaténée avec un %, en noir dans la barre.
     imagestring($image, 3, 115, 3, $pc."%", $noir);

//pour finir, on envoi l'image puis on la détruit, afin de ne pas mobiliser de mémoire inutilement. Le script s'achève ici.
     imagepng($image);
     imagedestroy($image);*/
require_once('../php/fonctions/connect.php');
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <title> Le Site dont tu es le Héros</title>
</head>

<body>
<?php //include "../php/Header.php"?>
    <main>
        <?php if (isset($_GET['id']))
        {
            $sql="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            $res=$bdd->query($sql);
            $ligne=$res->fetch();

            $images=glob("../images/".$ligne['branche_image'].'.{jpg,png}',GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['branche_titre'];
            $paragraphe=$ligne['branche_paragraphe'];
            $histoire=$ligne['branche_histoire_id']; //on recupère l'histoire associée à la branche
            $requeteVieInitiale="SELECT histoire_vie FROM histoire WHERE histoire_branche_id ='$histoire'"; //on prend la vie initiale de l'histoire
            $res=$bdd->query($requeteVieInitiale);
            $ligne=$res->fetch();
            $vieinitiale = $ligne['histoire_vie'];
            $vie;
            //Comment je fais pour savoir la vie qu'il a actuellement 
            $requeteVie="SELECT histoireEnCours_vie FROM histoireEnCours WHERE histoireEnCours_branche_id ='$_GET[id]'";
            $res=$bdd->query($requeteVie);
            $ligne=$res->fetch();
            if ($ligne['branche_id']!=2){
                $vie=$ligne['histoireEnCours_vie'] - $ligne['branche_vie'];
                //vieencours dans histoire en cours 
                //vie initiale dans histoire pour laisser le mec choisir

            }
            if ($ligne['branche_id']==2){
                $vie=$vieinitiale - $ligne['branche_vie'];
            }
            //On va maintenant enregistrer la variable vie dans la table histoire en cours associée au user_id
            //$requeteUser="SELECT * FROM branche WHERE branche_id='$_GET[id]'";
            //$_SESSION['login']
            $sql = "UPDATE histoireEnCours
                SET histoireEnCours_vie='$vie'
                WHERE histoireEnCours_branche_id ='$_GET[id]'";
                $bdd->query($sql);
          ?>
            
            <img class="FondBranche" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
            <h2><?=$titre?></h2>
            <br><br><br><br><br>
            <p><?=$paragraphe?></p>
            <br><br><br>
            <p>
            <img class="pv" src="../image/vie.png" alt="image coeur">
            <?=$vie?></p>
            <br><br><br>
            <?php 
        $sql = "SELECT * FROM brancheabranche WHERE brancheabranche_brancheactuelle_id ='$_GET[id]'"; //ou =branche_id? 
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
        ?>
            <a class="bouton choix" href="branche.php?id=<?= $ligne['brancheabranche_branchesuivante_id'] ?>" > <?= $ligne['brancheabranche_nombouton'] ?></a> 
            
            <?php
        }
        
        }
        ?>
    </main>




</body>

</html>