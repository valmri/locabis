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
                <a href="?page=compte" class="bouton">Gérer son compte</a>
            </div>

        </div>

    </aside>

    <div class="page">

        <div class="entetePage">
            <h1>Modification d'un avis</h1>
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

                <label for="note">Note : </label>
                <input type="number" name="note" id="note" min="0" max="5" value="<?= $avis->getNote(); ?>" required> <span> / 5</span><br>

                <label for="commentaire">Commentaire :</label><br>
                <textarea name="commentaire" id="commentaire" cols="30" rows="10" required><?= $avis->getCommentaire(); ?></textarea><br>

                <input type="hidden" name="jeton" id="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button type="submit">Envoyer</button>

            </form>

        </div>

    </div>

</div>