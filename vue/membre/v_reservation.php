<body onload="recuperationDatesReservees(<?= $laLocation->getId() ?>)">

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Résumé de la location</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Type :</span> <?php echo $laLocation->getType()->getLibeType(); ?></p>
                    <p><span class="titreInfo">Adresse :</span> <?php echo $laLocation->getImmeuble()->getAdresse(); ?> </p>
                    <p><span class="titreInfo">Ville :</span> <?php echo $laLocation->getImmeuble()->getVille(); ?> </p>

                    <?php if ($laLocation->getImmeuble()->isAscensseur()) : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Oui</p>
                    <?php else : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Non</p>
                    <?php endif; ?>

                    <p><span class="titreInfo">Prix :</span> <?php echo $laLocation->getType()->getTarifLocaBase(); ?>€</p>

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
            <div class="message msgInfo">
                <i class="las la-info-circle"></i>
                <p><?php echo $msgInfo; ?></p>
            </div>
            <?php endif; ?>

            <div class="contenuPage">
                <form action="#" method="post">
                    <label for="dateDebut">Date de début :</label>
                    <input type="text" name="dateDebut" id="dateDebut" placeholder="Début du séjour" required>
                    <input type="time" name="heureDebut" id="heureDebut" ><br>

                    <label for="dateFin">Date de fin :</label>
                    <input type="text" name="dateFin" id="dateFin" placeholder="Fin du séjour" required>
                    <input type="time" name="heureFin" id="heureFin" ><br>

                    <button type="submit">Réserver</button>
                </form>

            </div>

        </div>

    </div>