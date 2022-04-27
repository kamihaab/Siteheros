<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style stylelogin-->
        <link rel="stylesheet" href="../css/stylelogin.css"/>
    </head>
    <body>
        <div class="container">
            <!-- zone d'inscription-->
            
            <form action="verification.php" method="POST">
                <h1>Inscription</h1>

                <label><b>Nom </b></label>
                <input type="text" placeholder="Entrer votre nom" name="name" required>

                <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="surname" required>


                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' class="submit" value='SINSCRIRE' >
                <?php
                //check s'il y a pas de code 
                
                
                ?>
            </form>
        </div>
    </body>
</html>