


<header>
        <a href="index.php" ><h1> Le Site dont tu es le Héros
        </h1> </a>
        <?php 
//Don't forget session_start in other pages 
    if (isset( $_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
    {
        ?>Bienvenue, <?= $_SESSION['login']?>
        <a class="bouton connexion" href="fonctions/deconnexion.php">Se déconnecter</a>
        <?php
    }
    else
    {
        ?>
             <a class="bouton connexion" href="login.php">Connexion</a>
        <?php
    }
    ?>
       
</header>