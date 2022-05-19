<body>

<div class="contenu">
    <div class="page">
        <div class="entetePage">
            <h1>Page de connexion</h1>
        </div>

        <?php if (isset($msgErreur)) :?>
            <div class="message msgErreur">
                <i class="las la-exclamation-triangle"></i>
                <p><?php echo $msgErreur; ?></p>
            </div>
        <?php endif; ?>

        <form action="#" method="post">

            <div class="inputConnexion">
                <label for="identifiant">Identifiant</label></br>
                <input name="identifiant" type="text" required/></br>
            </div>

            <div class="inputConnexion">
                <label for="motDePasse">Mot de passe</label></br>
                <input name="motDePasse" type="password" required/></br>
            </div>

            <button class="boutonConnexion" type="submit">Se connecter</button>

        </form>
        
    </div>
</div>