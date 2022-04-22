<?php
    require_once('connect.php');
?><!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <title> Heros</title>
</head>
<body>
    <div class="container">
        
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target"> <!--menu burger button-->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-film"></span> Le site dont <b>VOUS</b> êtes le héros </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-target"> <!-- permet l'affichage ou non du menu!-->
                            <ul class="nav navbar-nav">
                    <li><a href="histoire_add.php">Ajouter un film</a></li>
                </ul>
                        <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> Bienvenue, paul <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Se déconnecter</a></li>
                        </ul>
                    </li>
                            </ul>
        </div>
    </div><!-- /.container -->

</nav>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                <img class="d-block w-100" src="#" data-src="holder.js/900x400?theme=social" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="#" data-src="holder.js/900x400?theme=industrial" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
            <!-- fin carou
            <?php
            /*$sql = "SELECT * FROM histoire";
            $res = $BDD->query($sql); //execute la requete
            while($tuple = $res->fetch()) { //fetch va a la ligne d'en dessous
                ?>

                    <article>
                <h3><a class="movieTitle" href="movie.php?id=<?=$tuple['mov_id']?>"><?=$tuple['mov_title']?></a></h3>
                <p class="movieContent"><?=$tuple['mov_description_short']?></p>
            </article><?php
            }
            */
            ?>



        <footer class="footer">
    <a>Devenez le maître de votre destin...</a>
</footer>    </div> -->

    <!-- jQuery -->
<script src="../lib/jquery/jquery.min.js"></script>
<!-- JavaScript Boostrap plugin -->
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>