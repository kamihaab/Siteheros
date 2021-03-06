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
    if (isset($_SESSION['estAdmin']) && $_SESSION['estAdmin'] = true) {
        if (isset($_POST["titre"])){
        $titre = addslashes($_POST['titre']);
        $resume = addslashes($_POST['resume']);
        
        
        $tmpFile = $_FILES['image']['tmp_name'];
            // upload image
            $fullname = $_FILES['image']['name'];
                $name = explode('.', $fullname)[0];
            $uploadedFile = "../images/$fullname";
            move_uploaded_file($tmpFile, $uploadedFile);
        
        
        // insert histoire into BD
        $requete = $bdd->prepare("INSERT INTO histoire (`histoire_titre`, `histoire_image`,`histoire_resume`) VALUES(?, ?, ?)"); 
        
        $requete->execute(array($titre,$name, $resume));
        header('location: ../index.php');
        exit; 
        }
    ?>
    <main>

        <div class="container"> <!--Ajout d'un film-->
            <form action="AjouterHistoire.php" name="inscription" enctype="multipart/form-data" method="POST">
                <h1>Ajouter une histoire</h1>
                </br>

                <label><b>Titre </b></label>
                <input type="text" placeholder="titre" name="titre" required>

                <label><b> Image</b></label>
                <input type="file" placeholder="image" name="image" required>

                <label><b>Résumé</b></label>
                <input type="text" placeholder="Resume" name="resume" required>

                <input type="submit" id='submit' class="submit" value='Ajouter' >
            </form>
        </div>

</main>

<?php }
else{
    header('location: ../index.php');
    exit;
}
?>
    </body>
</html>




