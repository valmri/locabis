<body>

<div class="contenu">

    <aside class="infos">

        <div class="info">

            <div class="enteteInfo">
                <h2>Appartement</h2>
            </div>

            <div class="contenuInfo">
                <p><span class="titreInfo">Titre :</span> <?= $appartement->getTitre(); ?></p>
                <p><span class="titreInfo">Description :</span> <?= $appartement->getDescription(); ?></p>
                <p><span class="titreInfo">Type :</span> <?= $appartement->getType(); ?></p>
            </div>

        </div>

    </aside>

    <div class="page">

        <div class="entetePage">
            <h1>Gérer son appartement</h1>
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
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" placeholder="Titre de l'appartement" value="<?= $appartement->getTitre(); ?>" required>

                <input type="hidden" name="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button type="submit">Modifier</button>
            </form>

            <form action="#" method="post">
                <label for="description">Description :</label><br>
                <textarea name="description" id="description" cols="30" rows="10" required><?= $appartement->getDescription(); ?></textarea><br>

                <input type="hidden" name="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button type="submit">Modifier</button>
            </form>

        </div>

    </div>

</div>