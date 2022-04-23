<body>

<div class="contenu">
    <div class="page">
        <div class="entetePage">
            <h1>Page d'inscription</h1>
        </div>

        <?php if (isset($msgErreur)) :?>
            <div class="message msgErreur">
                <i class="las la-exclamation-triangle"></i>
                <p><?php echo $msgErreur; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($msgInfo)) :?>
            <div class="message msgInfo">
                <i class="las la-info-circle"></i>
                <p><?php echo $msgInfo; ?></p>
            </div>
        <?php endif; ?>

        <form action="#" method="post">

            <div class="inputConnexion">
                <label for="nom">Nom</label></br>
                <input name="nom" type="text" required/></br>
            </div>

            <div class="inputConnexion">
                <label for="prenom">Prenom</label></br>
                <input name="prenom" type="text" required/></br>
            </div>

            <div class="inputConnexion">
                <label for="mel">Adresse mel</label></br>
                <input name="mel" type="text" required/></br>
            </div>

            <div class="inputConnexion">
                <label for="motDePasse">Mot de passe</label></br>
                <input name="motDePasse" type="password" required/></br>
            </div>

            <button class="boutonConnexion" type="submit">S'inscrire</button>

        </form>

    </div>
</div>