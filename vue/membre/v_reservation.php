<body onload="recuperationDatesReservees(<?= $laLocation->getId() ?>)">

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Résumé de la location</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Type :</span> <?php echo $type->getLibeType(); ?></p>
                    <p><span class="titreInfo">Adresse :</span> <?php echo $immeuble->getAdresse(); ?> </p>
                    <p><span class="titreInfo">Ville :</span> <?php echo $immeuble->getVille(); ?> </p>

                    <?php if ($immeuble->isAscenseur()) : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Oui</p>
                    <?php else : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Non</p>
                    <?php endif; ?>

                    <p><span class="titreInfo">Prix :</span> <?php echo $type->getTarifLocaBase(); ?>€</p>

                </div>

            </div>

        </aside>
    
        <div class="page">

            <div class="entetePage">
                <h1>Reservation</h1>
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
                    <i class="las la-calendar"></i>
                    <input type="text" name="dateDebut" id="dateDebut" placeholder="Début du séjour" required>
                    <input type="text" name="dateFin" id="dateFin" placeholder="Fin du séjour" required></br>

                    <button class="bouton" type="submit">Réserver</button>
                </form>

            </div>

        </div>

    </div>