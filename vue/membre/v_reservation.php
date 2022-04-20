<body>

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Résumé de la location</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Type :</span> <?php echo $laLocation->LIBETYPE; ?></p>
                    <p><span class="titreInfo">Adresse :</span> <?php echo $laLocation->ADRESSE; ?> </p>
                    <p><span class="titreInfo">Ville :</span> <?php echo $laLocation->VILLE; ?> </p>

                    <?php if ($laLocation->ASCENSSEUR) : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Oui</p>
                    <?php else : ?>
                        <p><span class="titreInfo">Ascenseur :</span> Non</p>
                    <?php endif; ?>

                    <p><span class="titreInfo">Prix :</span> <?php echo $laLocation->TARIFLOCABASE; ?>€</p>

                    <?php if (isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) :?>
                        <a href="?page=reserver&id=<?php echo $laLocation->ID; ?>" class="bouton">Louer</a>
                    <?php endif; ?>
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
                    <input type="date" name="dateDebut" id="dateDebut" required>
                    <input type="time" name="heureDebut" id="heureDebut" required><br>

                    <label for="dateFin">Date de fin :</label>
                    <input type="date" name="dateFin" id="dateFin" required>
                    <input type="time" name="heureFin" id="heureFin" required><br>

                    <button type="submit">Réserver</button>
                </form>

            </div>

        </div>

    </div>