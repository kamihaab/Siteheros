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
            $id = $_GET['id'];



            if (isset($_POST['titre'])) {
                $titre = addslashes($_POST['titre']);
                $sql = "UPDATE histoire
                SET histoire_titre='$titre'
                WHERE histoire_id='$id'";

                $bdd->query($sql);
            }
            if (isset($_POST['resume'])) {
                $resume = addslashes($_POST['resume']);
                $sql = "UPDATE histoire
                SET histoire_resume='$resume'
                WHERE histoire_id='$id'";

                $bdd->query($sql);
            }
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $sql = "SELECT * FROM histoire WHERE histoire_id='$id'";
                $res = $bdd->query($sql);
                $ligne = $res->fetch();
                $images = glob("../images/" . $ligne['histoire_image'] . '.{jpg,png}', GLOB_BRACE);
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

            $sql = "SELECT * FROM histoire WHERE histoire_id='$id'";
            $res = $bdd->query($sql);
            $ligne = $res->fetch();

            $idbranche = $ligne['histoire_branche_id'];

            $images = glob("../images/" . $ligne['histoire_image'] . '.{jpg,png}', GLOB_BRACE);
            $nomImage = $images[0];
            $titre = $ligne['histoire_titre'];
            $resume = $ligne['histoire_resume'];



        ?>

            <form action="pageHistoireAdmin.php?id=<?= $id ?> " method="POST">
                <textarea name="titre"><?= $titre ?></textarea>
                </br>
                <button type="submit">Enregistrer</button>
            </form>



            <a href="fonctions/supprimeHistoire.php?id=<?= $id ?>">
                <img id="poubellehistoire" class="droite" src=../images/poubelle.jpg alt="symbole Poubelle">
            </a>

            </br>
            <img class="imageCentrale" src="<?= $nomImage ?>" alt="image de <?= $nomImage ?>">

            <form action="pageHistoireAdmin.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                </br>
                <button type="submit">Enregistrer</button>
            </form>
            </br>


            <p class="breakword">
            <form action="pageHistoireAdmin.php?id=<?= $id ?> " method="POST">
                <textarea name="resume"><?= $resume ?></textarea>
                </br>
                <button type="submit">Enregistrer</button>
            </form>
            </p>

            </br>
            <a class="bouton commencerHistoire" href="branche.php?id=<?= $idbranche ?>"> Commencer une nouvelle histoire</a>

            </br>
            </br>
            
            <a id="anchora" class="bouton gauche" href="fonctions/rajouteBranche.php?idhistoire=<?= $id ?>">Rajouter Branche</a>
            <?php
            $sql = "SELECT * FROM branche WHERE branche_histoire_id='$id'";
            $res1 = $bdd->query($sql);
            while ($branchebandeau = $res1->fetch()) {
                $titrebandeau = $branchebandeau['branche_titre'];
                $idbranchebandeau = $branchebandeau['branche_id'];
            ?>
                <div id="<?= $idbranchebandeau ?>" class="branche" tabindex="0">
                    <div class="container bandeauBranche">
                        <h4><?= $titrebandeau ?></h4>
                        <a href="fonctions/supprimeBranche.php?idbranche=<?= $idbranchebandeau ?>&idhistoire=<?= $id ?>">
                            <img class="boutonbranche droite" src=../images/poubelle.jpg alt="symbole Poubelle">
                        </a>
                    </div>
                    <ul>
                        <h5>Branche précédente: 
                            <a class="bouton rajoutebranche" href="fonctions/rajouteBranche.php?idhistoire=<?= $id ?>&idbranchesuivante=<?=$idbranchebandeau?>">Rajouter Branche</a>
                            <div  class="dropdown" tabindex="0">
                            <a class="bouton rajoutebranche pointer">Relier</a>
                            <?php $dropdownid="dropdownprecedent".$idbranchebandeau?>
                            <div id="content<?=$dropdownid?>" class="dropdowncontent"> 
                            <input type="text" placeholder="Search.." id="input<?=$dropdownid?>" onkeyup="filterFunction('<?=$dropdownid?>')">
                            <?php
                            $sql = "SELECT branche_id,branche_titre FROM branche WHERE branche_histoire_id='$id'AND branche_id<>'$idbranchebandeau' AND
                            branche_id NOT IN 
                            (SELECT brancheabranche_brancheactuelle_id FROM brancheabranche WHERE brancheabranche_branchesuivante_id='$idbranchebandeau')";
                            $reqbranche1 = $bdd->query($sql);
                            while ($ligne = $reqbranche1->fetch()) {
                                $titrebranche=$ligne['branche_titre'];
                                $idbranchelien=$ligne['branche_id'];
                                ?>
                                <a href="fonctions/relier.php?idhistoire=<?=$id?>&idbrancheactuelle=<?=$idbranchelien?>&idbranchesuivante=<?=$idbranchebandeau?>"><?=$titrebranche?></a>
                           
                            <?php
                            }
                            ?>
                             </div>
                            </div>
            </h5>

                        <?php
                        $sql = "SELECT branche_titre,branche_id
                        FROM branche B, brancheabranche BB
                          WHERE B.branche_id=BB.brancheabranche_brancheactuelle_id
                           AND BB.brancheabranche_branchesuivante_id='$idbranchebandeau'";
                        $res2 = $bdd->query($sql);
                        while ($brancheprecedente = $res2->fetch()) {
                            $titrebrancheprecendente = $brancheprecedente['branche_titre'];
                            $branche_idprecedente = $brancheprecedente['branche_id'];
                        ?>
                            <li>
                                <div class="container">
                                    <div class="titrebranche"><a href="#<?= $branche_idprecedente ?>"><?= $titrebrancheprecendente ?></a></div>
                                    <div class="boutonsbranche">
                                        <a href="fonctions/unlink.php?idhistoire=<?= $id ?>&idbrancheprecedente=<?= $branche_idprecedente ?>&idbrancheactuelle=<?= $idbranchebandeau ?>">
                                            <img class="boutonbranche" src=../images/unlink.png alt="bouton permettant de détruire le lien entre les branches">
                                        </a>
                                        <a href="fonctions/supprimeBranche.php?idbranche=<?= $branche_idprecedente ?>&idhistoire=<?= $id ?>">
                                            <img class="boutonbranche" src=../images/poubelle.jpg alt="symbole Poubelle">
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        <h5>Branche suivante:
                            <a class="bouton rajoutebranche" href="fonctions/rajouteBranche.php?idhistoire=<?= $id ?>&idbrancheprecedente=<?=$idbranchebandeau?>">Rajouter Branche</a>
                            <div  class="dropdown" tabindex="0">
                            <a class="bouton rajoutebranche pointer">Relier</a>

                            <?php $dropdownid="dropdownsuivant".$idbranchebandeau?>

                            <div id="content<?=$dropdownid?>" class="dropdowncontent">
                            <div class="container">
                            <img class="imageloupe" src="../images/Searchicon.png">
                            <input type="text" placeholder="Search.." id="input<?=$dropdownid?>" onkeyup="filterFunction('<?=$dropdownid?>')">
                            </div>
                            <?php
                            $sql = "SELECT branche_id,branche_titre FROM branche WHERE branche_histoire_id='$id'AND branche_id<>'$idbranchebandeau' AND
                            branche_id NOT IN 
                            (SELECT brancheabranche_branchesuivante_id FROM brancheabranche WHERE brancheabranche_brancheactuelle_id='$idbranchebandeau')";
                            $reqbranche2 = $bdd->query($sql);
                            while ($ligne = $reqbranche2->fetch()) {
                                $titrebranche=$ligne['branche_titre'];
                                $idbranchelien=$ligne['branche_id'];
                                ?>
                                <a href="fonctions/relier.php?idhistoire=<?=$id?>&idbranchesuivante=<?=$idbranchelien?>&idbrancheactuelle=<?=$idbranchebandeau?>"><?=$titrebranche?></a>
                           
                            <?php
                            }
                            ?>
                             </div>
                            </div>
                        </h5>
                        <?php
                        $sql = "SELECT branche_titre,branche_id
                        FROM branche B, brancheabranche BB
                          WHERE B.branche_id=BB.brancheabranche_branchesuivante_id
                           AND BB.brancheabranche_brancheactuelle_id='$idbranchebandeau'";
                        $res2 = $bdd->query($sql);
                        while ($branchesuivante = $res2->fetch()) {
                            $titrebranchesuivante = $branchesuivante['branche_titre'];
                            $branche_idsuivante = $branchesuivante['branche_id'];
                        ?>
                            <li>
                                <div class="container">
                                    <div class="titrebranche"><a href="#<?= $branche_idsuivante ?>"><?= $titrebranchesuivante ?></a></div>
                                    <div class="boutonsbranche">
                                        <a href="fonctions/unlink.php?idhistoire=<?= $id ?>&idbrancheprecedente=<?= $idbranchebandeau ?>&idbrancheactuelle=<?= $branche_idsuivante ?>">
                                            <img class="boutonbranche" src=../images/unlink.png alt="bouton permettant de détruire le lien entre les branches">
                                        </a>
                                        <a href="fonctions/supprimeBranche.php?idbranche=<?= $branche_idsuivante ?>&idhistoire=<?= $id ?>">
                                            <img class="boutonbranche" src=../images/poubelle.jpg alt="symbole Poubelle">
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>


                        <a class="bouton changerbranche" href="branche.php?id=1">Changer la branche</a>
                    </ul>
                </div>
            <?php
            }
            ?>

        <?php
        }
        ?>

    </main>

    <script src="../Js/forDropdown.js"></script>
</body>

</html>