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
                <i class="las la-user"></i>
                <input name="identifiant" type="text" placeholder="Adresse-mél" required/>
            </div>

            <div class="inputConnexion">
                <i class="las la-lock"></i>
                <input name="motDePasse" type="password" placeholder="Mot de passe" required/>
            </div>

            <button class="bouton btnConnexion" type="submit">Se connecter</button>

        </form>
        
    </div>
</div>