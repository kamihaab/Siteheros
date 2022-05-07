<?php
require_once('fonctions/connect.php');
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/stylelogin.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title> Le Site dont tu es le Héros</title>
</head>


<?php include "Header.php" ?>

<body>
    <?php
    if (isset($_GET['id'])&& isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] = true) {
        $id =$_GET['id'];

        $sql = "SELECT * FROM branche WHERE branche_id=$id";
        $res = $bdd->query($sql);
        $ligne = $res->fetch();

        $titre = $ligne['branche_titre'];
        $paragraphe = $ligne['branche_paragraphe'];
        $idhistoire = $ligne['branche_histoire_id'];
        if (isset($_POST['titre'])) {
            $titre = addslashes($_POST['titre']);
            $paragraphe = addslashes($_POST['paragraphe']);
            $sql = "UPDATE branche
                SET branche_titre='$titre',
                branche_paragraphe='$paragraphe'
                WHERE branche_id='$id'";
            $bdd->query($sql);

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
              
                $images = glob("../images/" . $ligne['branche_image'] . '.{jpg,png}', GLOB_BRACE);
                $fichier = $images[0];
                if (file_exists($fichier)) {
                    unlink($fichier);
                }
    
                $tmpName = $_FILES['file']['tmp_name'];
                $fullname = $_FILES['file']['name'];
                $name = explode('.', $fullname)[0]; //split string when there is a "." so full name is with png jpg etc
    
                move_uploaded_file($tmpName, '../images/' . $fullname);
    
                $sql = "UPDATE histoire
                    SET histoire_image='$name'
                    WHERE histoire_id='$id'";
                $bdd->query($sql);
            }


            header('location: pageHistoireAdmin.php?id='.$idhistoire.'#'.$id);
            exit; 
        }


    ?>
        <main>

            <div class="container">
                <!--Ajout d'un film-->
                <form action="changeBranche.php?id=<?=$id?>" name="inscription" enctype="multipart/form-data" method="POST">
                    <h2>Ajouter une histoire</h2>
                    </br>

                    <label><b>Titre </b></label>
                    <input type="text" placeholder="titre" name="titre" value=<?= $titre ?>>

                    <label><b> Image</b></label>
                    <input type="file" placeholder="image" name="image">

                    <label><b>Résumé</b></label>
                    <textarea name="paragraphe"><?= $paragraphe ?></textarea>

                    <input type="submit" id='submit' class="submit" value='Ajouter'>
                </form>
            </div>
        </main>
    <?php } else {
        echo "aaaaa";
        //header('location: index.php');
        //exit;
    }
    ?>
</body>

</html>