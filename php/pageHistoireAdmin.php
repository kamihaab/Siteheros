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
        if (isset($_GET['id']) && isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] == true) {
            $id=$_GET['id'];
            
            if (isset($_POST['titre']))
            {
                $titre=$_POST['titre'];
                $sql="UPDATE histoire
                SET histoire_titre='$titre'
                WHERE histoire_id='$id'";

                $bdd-> query($sql);
            }
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $fullname = $_FILES['file']['name'];
                $name = explode('.', $fullname)[0]; //split string when there is a "." so full name is with png jpg etc

                move_uploaded_file($tmpName, '../images/' . $fullname);

                $sql = 'UPDATE histoire
                SET histoire_image="$name"
                WHERE histoire_titre=addslashes($_GET["name"]) ';
                $bdd->query($sql);

            }

            $sql = "SELECT * FROM histoire WHERE histoire_id='$id'";
            $res = $bdd->query($sql);
            $ligne = $res->fetch();

            $idbranche = $ligne['histoire_branche_id'];

            $images = glob("../images/" . $ligne['histoire_image'] . '.{jpg,png}', GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['histoire_titre'];
            $resume = $ligne['histoire_resume'];



        ?>

            <form action="pageHistoireAdmin.php?id=<?=$id?> " method="POST">
                <textarea  name="titre"><?=$titre?> </textarea>
        </br>
                <button type="submit">Enregistrer</button>
            </form>



            <a href="fonctions/supprimeHistoire.php?id=<?= $id?>">
                <img id="poubelle" class="droite" src=../images/poubelle.jpg alt="symbole Poubelle">
            </a>

            </br>
            <img class="imageCentrale" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">

            <form action="pageHistoireAdmin.php?id=<?= $id?>" method="POST" enctype="multipart/form-data">
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