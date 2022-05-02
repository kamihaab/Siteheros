<?php
require_once('fonctions/connect.php');
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
<?php include "Header.php"?>
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
            ?>

            <img class="FondBranche" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
            <h2><?=$titre?></h2>
            <br><br><br><br><br>
            <p><?=$paragraphe?></p>
            <br><br><br>
        
            <a class="bouton choix">Sauter</a>
            <a class="bouton choix">Courir</a>
            </main>
            <?php
        }
        ?>




</body>

</html>