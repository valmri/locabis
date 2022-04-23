<body>

<div class="contenu">

    <aside class="infos">

        <div class="info">

            <div class="enteteInfo">
                <h2>Mes informations</h2>
            </div>

            <div class="contenuInfo">
                <p><span class="titreInfo">Identité :</span> <?= $utilisateur->getPrenom().' '.$utilisateur->getNom(); ?></p>
                <p><span class="titreInfo">Adresse-mel :</span> <?= $utilisateur->getMel(); ?></p>
                <p><span class="titreInfo">Dernière connexion :</span> <?= date('d/m/Y H:m', strtotime($utilisateur->getDateConnexion())); ?></p>
            </div>

        </div>

    </aside>

    <div class="page">

        <div class="entetePage">
            <h1>Gérer son compte</h1>
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

        <div class="contenuPage">

            <form action="#" method="post">
                <label for="mel">Nouvelle adresse mél :</label>
                <input type="text" name="mel" id="mel" placeholder="Adresse mel" required>

                <input type="hidden" name="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button type="submit">Modifier</button>
            </form>

            <form action="#" method="post">
                <label for="motdepasse">Nouveau mot de passe :</label>
                <input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required>

                <input type="hidden" name="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button type="submit">Modifier</button>
            </form>

        </div>

    </div>

</div>