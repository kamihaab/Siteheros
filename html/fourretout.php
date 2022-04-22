<?php
            $sql = "SELECT * FROM histoire";
            $res = $BDD->query($sql); //execute la requete
            while($tuple = $res->fetch()) { //fetch va a la ligne d'en dessous
                ?>
                    <article>
                <h3><a class="movieTitle" href="movie.php?id=<?=$tuple['mov_id']?>"><?=$tuple['mov_title']?></a></h3>
                <p class="movieContent"><?=$tuple['mov_description_short']?></p>
            </article><?php
            }
            ?>