<?php
require_once('connect.php')
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
        if (isset($_GET['name'])) {
        ?>
            <?php 
            $sql='SELECT * FROM histoire WHERE histoire_titre=\''.addslashes($_GET["name"]).'\'';
            $res=$bdd->query($sql);
            $ligne=$res->fetch();

            $idbranche=$ligne['histoire_branche_id'];
            $nomImage = $ligne['histoire_image'];
            $titre = $ligne['histoire_titre'];
            $resume=$ligne['histoire_resume'];
            ?>

            <h2><?=$titre?></h2>
            </br>
            <img class="imageCentrale" src="../images/<?= $nomImage ?>.jpg" alt="image de <?= $nomImage ?>">
            <p>
                <?= $resume?>
            </p>
            </br>
            <a class="bouton commencerHistoire" href="branche.php?id=<?=$idbranche?>"> Commencer une nouvelle histoire</a>
        <?php
        }
        ?>

    </main>


</body>

</html>