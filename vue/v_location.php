<body>

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Informations</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Type :</span> <?php echo $appartement->getType()->getLibeType(); ?></p>
                    <p><span class="titreInfo">Adresse :</span> <?php echo $appartement->getImmeuble()->getAdresse(); ?> </p>
                    <p><span class="titreInfo">Ville :</span> <?php echo $appartement->getImmeuble()->getVille(); ?> </p>

                    <?php if ($appartement->getImmeuble()->isAscensseur()) : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Oui</p>
                    <?php else : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Non</p>
                    <?php endif; ?>

                    <p><span class="titreInfo">Prix :</span> <?php echo $appartement->getType()->getTarifLocaBase(); ?>€</p>

                    <?php if (isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) :?>
                        <a href="?page=reserver&id=<?php echo $appartement->getId(); ?>" class="bouton">Louer</a>
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
                <div class="message msgInfo">
                    <i class="las la-info-circle"></i>
                    <p><?php echo $msgInfo; ?></p>
                </div>
            <?php endif; ?>

            <div class="entetePage">
                <?php if ($appartement->getPhoto() != null) : ?>
                    <img src="./images/apparts/<?php echo $appartement->getPhoto(); ?>.jpg" width="50%" alt="<?php $appartement->getType()->getLibeType(); ?>">
                <?php else :?>
                    <img src="./assets/img/appart.jpg" width="50%" alt="<?php echo $appartement->getType()->getLibeType(); ?>">
                <?php endif; ?>
                <h1><?php echo $appartement->getTitre(); ?></h1>
            </div>

            <div class="contenuPage">
                <p><?php echo $appartement->getDescription(); ?></p>
            </div>
            <?php if ($estEquipe) : ?>
            <h3>Equipements :</h3>
            <div class="equipements">
                <?php foreach ($appartement->getEquipements() as $equipement) : ?>
                <div class="equipement">
                    <i class="<?= $equipement->getIcone(); ?>"></i>
                    <p><?= $equipement->getQuantite().' '.$equipement->getLibelle(); ?></p>
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

                        <button type="submit">Envoyer</button>
                    </form>
                <?php elseif($avisExiste) : ?>
                    <p>Un avis a déjà été donné, vous pouvez modifier votre avis.</p>
                <?php else : ?>
                    <p>Une réservation doit être validée pour donner un avis.</p>
                <?php endif; ?>

                <?php endif; ?>
                <?php if ($lesAvis) : ?>
                <?php foreach ($appartement->getAvis() as $avis) : ?>
                <div class="avis">
                    <div class="avisEntete">
                        <p><?= $avis->getUtilisateur();?> - <?= $avis->getDatePublication();?></p>
                        <span>Note : <?= $avis->getNote();?>/5</span>
                    </div>
                    <div class="avisCorps">
                        <p><?= $avis->getCommentaire();?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Aucun avis de publié.</p>
                <?php endif; ?>

            </div>

        </div>


    </div>