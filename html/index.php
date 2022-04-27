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

<?php include "Header.php"?>
    <main class="StoryContainer">
    <div class="Story">
        <?php
        $sql=SELECT * FROM hisoire WHERE histoire_id=1;
        $res=
        ?>
            <h3>En cours</h3>
                <a href="pageHistoire.php?name='Fait chaud'">
        
                <img class="imgStory" src="../images/desert.jpg" alt="image de Zenitsu">
                <h2>Fait chaud</h2>
            </a>
        </div>
        

        <div class="Story">
            <h3>En cours</h3>
                <a href="pageHistoire.php?name='Fait chaud'">
        
                <img class="imgStory" src="../images/desert.jpg" alt="image de Zenitsu">
                <h2>Fait chaud</h2>
            </a>
        </div>
        <div class="Story">
            <h3>En cours</h3>
                <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
        
                <img class="imgStory" src="../images/mer.jpg" alt="image de Zenitsu">
                <h2>L'eau ca mouille</h2>
            </a>
        </div>
    <div class="Story">
        <h3>En cours</h3>
            <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
    
            <img class="imgStory" src="../images/desert.jpg" alt="image de Zenitsu">
            <h2>Fait chaud</h2>
        </a>
    </div>
    <div class="Story">
        <h3>En cours</h3>
            <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
    
            <img class="imgStory" src="../images/mer.jpg" alt="image de Zenitsu">
            <h2>L'eau ca mouille</h2>
        </a>
    </div>

    <div class="Story">
        <h3>En cours</h3>
            <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
    
            <img class="imgStory" src="../images/Zenitsu.jpg" alt="image de Zenitsu">
            <h2> Zenistu l'Eclair</h2>
        </a>
    </div>
    <div class="Story">
        <h3>En cours</h3>
            <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
    
            <img class="imgStory" src="../images/desert.jpg" alt="image de Zenitsu">
            <h2>Fait chaud</h2>
        </a>
    </div>
    <div class="Story">
        <h3>En cours</h3>
            <a href="https://askcodez.com/sensible-galerie-dimage-a-laide-de-css-flexbox-ou-une-grille-de-mise-en-page.html">
    
            <img class="imgStory" src="../images/Zenitsu.jpg" alt="image de Zenitsu">
            <h2> Zenistu l'Eclair</h2>
        </a>
    </div>

    </main>

</body>

</html>