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

        </div>

    </div>