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
                <i class="las la-user"></i>
                <input name="nom" type="text" placeholder="Nom*" required/>
                <input name="prenom" type="text" placeholder="Prénom*" required/>
            </div>

            <div class="inputConnexion">
                <i class="las la-at"></i>
                <input name="mel" type="text" placeholder="Adresse-mél*" required/>
            </div>

            <div class="inputConnexion">
                <i class="las la-lock"></i>
                <input name="motDePasse" type="password"  placeholder="Mot de passe*" required/>
                <input name="motDePasseConf" type="password" placeholder="Confirmez le mot de passe*" required/>
            </div>

            <button class="bouton btnConnexion" type="submit">S'inscrire</button>

        </form>

    </div>
</div>