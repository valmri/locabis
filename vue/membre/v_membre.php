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
                            <span class="infoLoca">
                                <i class="las <?php echo $reservation->getEtat()->getIcone();?>"></i><strong>Statut : </strong><?php echo $reservation->getEtat()->getLibelle();?>
                            </span></br>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Début : </strong><?php echo date('d/m/Y H:m', strtotime($reservation->getDateDebut())); ?>
                            </span></br>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Fin : </strong><?php echo date('d/m/Y H:m', strtotime($reservation->getDateFin())); ?>
                            </span>
                            <a href="?page=location&id=<?php echo $reservation->getAppartement()->getId(); ?>" class="bouton">Consulter</a>
                            <a onclick="test()" href="#" class="bouton">Annuler</a>
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