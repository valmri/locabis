<body>

    <div class="contenu contenuAppart">

        <aside class="infos descAppart">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Informations</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Type :</span> <?= $type->getLibetype(); ?></p>
                    <p><span class="titreInfo">Adresse :</span> <?= $immeuble->getAdresse(); ?> </p>
                    <p><span class="titreInfo">Ville :</span> <?= $immeuble->getVille(); ?> </p>

                    <?php if ($immeuble->isAscenseur()) : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Oui</p>
                    <?php else : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Non</p>
                    <?php endif; ?>

                    <p><span class="titreInfo">Prix :</span> <?= $type->getTarifLocaBase(); ?>€</p>

                    <?php if (isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) :?>
                        <a href="?page=reserver&id=<?php echo $appartement->getId(); ?>" class="bouton">Louer</a>
                    <?php else :  ?>
                    <div class="message msgInfo">
                        <i class="las la-info-circle"></i>
                        <p>Vous devez avoir un compte pour pouvoir louer.</p>
                    </div>
                    <?php endif; ?>
                </div>

            </div>

        </aside>

        <div class="page">

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

            <div class="entetePage">
                <?php if ($appartement->getPhoto() !== null) : ?>
                    <img src="./images/apparts/<?= $appartement->getPhoto(); ?>.jpg" width="50%" alt="<?= $type->getLibeType(); ?>">
                <?php else :?>
                    <img src="./assets/img/appart.jpg" width="50%" alt="<?php echo $appartement->getType()->getLibeType(); ?>">
                <?php endif; ?>
                <h1><?php echo $appartement->getTitre(); ?></h1>
            </div>

            <div class="contenuPage">
                <p><?php echo $appartement->getDescription(); ?></p>
            </div>
            <?php if ($collectionEquipement->count() > 0) : ?>
            <h3>Equipements :</h3>
            <div class="equipements">
                <?php foreach ($collectionEquipement as $equipement) : ?>
                <div class="equipement">
                    <i class="<?= $equipement->get(0); ?>"></i>
                    <p><?= $equipement->get(1).' '.$equipement->get(2); ?></p>
                </div>
                <?php endforeach; ?>
                
            </div>
            <?php endif; ?>

            <div class="carteAvis">

                
                <h3 id="avis">Avis :</h3>

                <?php if(isset($reservation) && $reservation) : ?>

                <?php if(!$avisExiste && $reservation->getEtat() === "3") : ?>
                    <form action="#" method="post">
                        <label for="note">Note : </label>
                        <input type="number" name="note" id="note" min="0" max="5" required> <span> / 5</span><br>

                        <label for="commentaire">Commentaire :</label><br>
                        <textarea name="commentaire" id="commentaire" cols="30" rows="10" required></textarea><br>

                        <button class="bouton" type="submit">Envoyer</button>
                    </form>
                <?php elseif($avisExiste) : ?>
                    <div class="message msgInfo">
                        <i class="las la-info-circle"></i>
                        <p>Un avis a déjà été donné, vous pouvez modifier votre avis.</p>
                    </div>
                <?php elseif(!$avisExiste && $reservation->getEtat() === "1") : ?>
                    <div class="message msgInfo">
                        <i class="las la-info-circle"></i>
                        <p>Une réservation doit être validée pour donner un avis.</p>
                    </div>
                <?php endif; ?>

                <?php endif; ?>
                <?php if ($lesAvis) : ?>
                <?php foreach ($lesAvis as $avis) : ?>
                <div class="avis">
                    <div class="avisEntete">
                        <p><?= $avis->get(2);?> - <?= $avis->get(3);?></p>
                        <?php if(isset($avisExiste) && $avisExiste && (int)$utilisateur->getId() === (int)$avis->get(1)) :?>
                            <a href="?page=avis&id=<?= $avis->get(0) ?>">Modifier</a>
                        <?php endif; ?>

                        <span>Note : <?= $avis->get(4);?>/5</span>
                    </div>
                    <div class="avisCorps">
                        <p><?= $avis->get(5); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Aucun avis de publié.</p>
                <?php endif; ?>

            </div>

        </div>


    </div>