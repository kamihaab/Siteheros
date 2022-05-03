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

    <main class="StoryContainer">
        <?php
        $sql = "SELECT * FROM histoire    ";
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
        ?>
            <div class="Story">
                <?php
                $images = glob("../images/" . $ligne['histoire_image'] . '.{jpg,png}', GLOB_BRACE);
                $nomImage = $images[0];
                $titre = $ligne['histoire_titre'];
                $id=$ligne['histoire_id'];
                ?>

                <h3>En cours</h3>
                <?php
                if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
                ?>
                    <a href="pageHistoireAdmin.php?id=<?= $id ?>">
                        <img class="imgStory" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
                        <h2><?= $titre ?></h2>
                    </a>
                <?php
                } else {
                ?>
                    <a href="pageHistoire.php?id=<?= $id ?>">
                        <img class="imgStory" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">
                        <h2><?= $titre ?></h2>
                    </a>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </main>

</body>

</html>