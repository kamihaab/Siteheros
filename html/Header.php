<?php require_once "connect.php"; 
session_start();
?>

<header>
        <a href="index.php" ><h1> Le Site dont tu es le Héros
        </h1> </a>
        <?php if (isUserConnected()){ ?>
            Bienvenue, <?= $_SESSION['login'] ?>
            <a class="bouton connexion" href="logout.php">Déconnexion</a>
        <?php } else { ?>
        <a class="bouton connexion" href="login.php">Connexion</a>
        <?php } ?>

    </header>