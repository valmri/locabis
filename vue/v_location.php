<body>

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Informations</h2>
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
                <?php if ($laLocation->IMAGE != null) :?>
                    <img src="./images/apparts/<?php echo $laLocation->IMAGE; ?>.jpg" width="50%" alt="<?php echo $laLocation->LIBETYPE; ?>">
                <?php else :?>
                    <img src="./assets/img/appart.jpg" width="50%" alt="<?php echo $laLocation->LIBETYPE; ?>">
                <?php endif; ?>
                <h1><?php echo $laLocation->TITRE; ?></h1>
            </div>

            <div class="contenuPage">
                <p><?php echo $laLocation->DESCRIPTION; ?></p>
            </div>

        </div>

    </div>