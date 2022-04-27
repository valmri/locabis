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
                    <?php if($utilisateur->getRole() === 2) : ?>
                        <p><span class="titreInfo">Adresse :</span> <?= $proprietaire->getAdresse(); ?></p>
                        <p><span class="titreInfo">Ville :</span> <?= $proprietaire->getVille(); ?></p>
                        <p><span class="titreInfo">Téléphone :</span> <?= $proprietaire->getTelephone(); ?></p>
                    <?php endif; ?>
                    <p><span class="titreInfo">Dernière connexion :</span> <?= date('d/m/Y H:m', strtotime($utilisateur->getDateConnexion())); ?></p>
                    <a href="?page=compte" class="bouton">Gérer son compte</a>
                </div>

            </div>

        </aside>
    
        <div class="page">

            <div class="entetePage">
                <h1>Vos réservations</h1>
            </div>

            <div class="contenuPage">

                <?php if(empty($reservations)): ?>
                <p>Vous n'avez réaliser aucunes réservations.</p>
                <?php
                else :
                foreach ($reservations as $reservation) :
                ?>

                    <?php if ($nbCase === 0) :?>
                    <div class="contenuCarte">
                    <?php endif; ?>

                    <div class="carteLoc">
                        <div class="carteLoc_contenu">
                            <h2><?php echo $reservation->getAppartement()->getTitre(); ?></h2>
                            <span id="statutReservation" class="infoLoca">
                                <i class="<?php echo $reservation->getEtat()->getIcone();?>"></i><strong>Statut : </strong><?php echo $reservation->getEtat()->getLibelle();?>
                            </span></br>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Début : </strong><?php echo date('d/m/Y', strtotime($reservation->getDateDebut())); ?>
                            </span></br>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Fin : </strong><?php echo date('d/m/Y', strtotime($reservation->getDateFin())); ?>
                            </span>
                            <input class="idReservations" type="hidden" value="<?= $reservation->getId(); ?>">
                            <a href="?page=location&id=<?php echo $reservation->getAppartement()->getId(); ?>" class="bouton">Consulter</a>
                            <?php if($reservation->getEtat()->getId() === 3): ?>
                            <button onclick="archiverReservation(<?= $reservation->getAppartement()->getId(); ?>, <?= $reservation->getId(); ?>)" class="bouton">Archiver</button>
                            <?php endif; ?>
                            <?php if($reservation->getEtat()->getId() === 1 && $reservation->getEtat()->getId() === 3 && $reservation->getEtat()->getId() === 3): ?>
                            <button onclick='annulationReservation(<?= $reservation->getId(); ?>, "<?= $reservation->getAppartement()->getTitre(); ?>")' class='bouton'>Annuler</button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php $nbCase++; ?>
                    <?php if ($nbCase === 2) :?>
                    </div>
                    <?php $nbCase = 0;?>
                    <?php endif; ?>

                <?php
                endforeach;
                endif;
                ?>

            </div>

        </div>

    </div>