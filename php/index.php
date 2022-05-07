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

    <?php
    if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
    ?>

    <div>
    <a class="bouton ajout" href="AjouterHistoire.php">Ajouter une histoire</a>
    </div>
    <?php
        }
    ?>

    <main class="StoryContainer">
        <?php
        $sql = "SELECT * FROM histoire    ";
        $res = $bdd->query($sql);
        while ($ligne = $res->fetch()) {
        ?>
            <div class="Story">
                <?php
                $images = glob("../images/" . $ligne['histoire_image'] . '.{jpg,png}', GLOB_BRACE);
                $nomImage = $images[0]; //On m'indique une erreur ici? 
                $titre = $ligne['histoire_titre'];
                $id=$ligne['histoire_id'];

            if (isset( $_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
                {
            $sql = "SELECT histoireEnCours_branche_id FROM histoireEnCours
             WHERE histoireEnCours_usr_id='$_SESSION[iduser]'
             AND histoireEnCours_branche_id IN
             (SELECT branche_id FROM branche WHERE branche_histoire_id='$id')";
             $res1 = $bdd->query($sql);
            if($ligne=$res1->fetch())
            {
                ?>
                <h3>En cours</h3>
                <?php
            }
            else{
                ?>
                <h3>Non commencé</h3>
                <?php
            }
        }
        else{
            ?>
            </br>
            <?php
        }
            ?>
            
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