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
                <?php if($equipements) : ?>
                <span class="titreInfo">Équipements :</span>
                <ul>
                    <?php foreach ($equipements as $equipement) :?>

                    <li>
                        <i class="<?= $equipement->getIcone(); ?>"></i>
                        <?= $equipement->getQuantite().' '.$equipement->getLibelle(); ?>
                    </li>

                    <?php endforeach;?>
                </ul>
                <?php endif; ?>
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
            <div class="message msgConfirmation">
                <i class="las la-info-circle"></i>
                <p><?php echo $msgInfo; ?></p>
            </div>
        <?php endif; ?>

        <div class="contenuPage">

            <form action="#" method="post">
                <label for="titre">Titre :</label><br>
                <input class="inputTitre" type="text" name="titre" id="titre" placeholder="Titre de l'appartement" value="<?= $appartement->getTitre(); ?>" required>
                <br>
                <label for="description">Description :</label><br>
                <textarea name="description" id="description" cols="30" rows="10" required><?= $appartement->getDescription(); ?></textarea><br>

                <input type="hidden" name="jeton" value="<?= $_SESSION['jeton'] ?>">

                <button class="bouton" type="submit">Modifier</button>
            </form>

            <form action="#" method="post">
                <?php foreach ($listeEquipements as $equipement) :?>


                <div>
                    <label for="equipement<?= $equipement->getId(); ?>"><?= $equipement->getLibelle(); ?></label>
                    <input type="checkbox" name="equipements[<?= $equipement->getId(); ?>][id]" id="equipement<?= $equipement->getId(); ?>" value="<?= $equipement->getId(); ?>">
                    <input type="number" id="equipement<?= $equipement->getId(); ?>" name="equipements[<?= $equipement->getId(); ?>][quantite]" value="0" min="0" max="50">
                </div>


                <?php endforeach; ?>
                <button class="bouton" type="submit">Modifier</button>
            </form>

        </div>

    </div>

</div>