<?php
require_once('connect.php');
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
    <main class="StoryContainer">
        <?php
        $sql = "SELECT * FROM histoire    ";
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
        ?>
            <div class="Story">
                <?php
                $nomImage = $ligne['histoire_image'];
                $titre = $ligne['histoire_titre'];
                ?>

                <h3>En cours</h3>
                <a href="pageHistoire.php?name=<?=$titre?>">
                    <img class="imgStory" src="../images/<?= $nomImage ?>.jpg" alt="image de <?= $nomImage ?>">
                    <h2><?= $titre ?></h2>
                </a>
            </div>
        <?php
        }
        ?>
    </main>

</body>

</html>