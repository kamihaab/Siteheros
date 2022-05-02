<?php
require_once('fonctions/connect.php')
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
            
            $sql = 'SELECT * FROM histoire WHERE histoire_titre=\'' . addslashes($_GET["name"]) . '\'';
            $res = $bdd->query($sql);
            $ligne = $res->fetch();

            $idbranche = $ligne['histoire_branche_id'];
            $nomImage = $ligne['histoire_image'];
            $titre = $ligne['histoire_titre'];
            $resume = $ligne['histoire_resume'];

            if(isset($_FILES['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                move_uploaded_file($tmpName, '../images/'.$name);
            }
            ?>

            <h2><?= $titre ?></h2>

            <a  href="fonctions/supprimeHistoire.php?name=<?= $_GET['name'] ?>">
                <img id="poubelle" class="droite" src=../images/poubelle.jpg alt="symbole Poubelle">
            </a>

            </br>
            <img class="imageCentrale" src="../images/<?= $nomImage ?>.jpg" alt="image de <?= $nomImage ?>">
            
            <form action="pageHistoire.php?name=<?=$_GET["name"]?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                </br>
                <button type="submit">Enregistrer</button>
            </form>
            </br>
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