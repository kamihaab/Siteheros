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
    <?php include "Header.php" ?>
    <main>
        <?php
        if (isset($_GET['id'])) {
        ?>  
            <?php
            $id=$_GET['id'];
            
            $sql = "SELECT * FROM histoire WHERE histoire_id=$id";
            $res = $bdd->query($sql);
            $ligne = $res->fetch();

            $idbranche = $ligne['histoire_branche_id'];
            
            $images=glob("../images/".$ligne['histoire_image'].'.{jpg,png}',GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['histoire_titre'];
            $resume = $ligne['histoire_resume'];

            ?>


            <h2><?= $titre ?></h2>

            </br>
            <img class="imageCentrale" src="<?= $nomImage?>" alt="image de <?= $nomImage ?>">
    
            <p class="breakword">
                <?= $resume ?>
            </p>
            </br>
            <a class="bouton commencerHistoire" href="branche.php?id=<?= $idbranche ?>"> Commencer une nouvelle histoire</a>
        <?php
        }
        ?>

    </main>


</body>

</html>