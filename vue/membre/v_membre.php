<body>

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Mes informations</h2>
                </div>

                <div class="contenuInfo">
                    <p><span class="titreInfo">Identité :</span> <?php echo $utilisateur->getPrenom().' '.$utilisateur->getNom(); ?></p>
                    <p><span class="titreInfo">Adresse-mel :</span> <?php echo $utilisateur->getMel(); ?></p>
                    <p><span class="titreInfo">Dernière connexion :</span> <?php echo $derniereConnexion; ?></p>
                </div>

            </div>

        </aside>
    
        <div class="page">

            <div class="entetePage">
                <h1>Vos réservations</h1>
            </div>

            <div class="contenuPage">

                <?php if(empty($utilisateur->getReservations())): ?>
                <p>Vous n'avez réaliser aucunes réservations.</p>
                <?php
                else :
                foreach ($reservationsUtilisateur as $uneReservation) :
                ?>

                    <?php if ($nbCase === 0) :?>
                    <div class="contenuCarte">
                    <?php endif; ?>

                    <div class="carteLoc">
                        <div class="carteLoc_contenu">
                            <h2><?php echo $uneReservation->getAppartement()->getTitre(); ?></h2>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Début : </strong><?php echo date('d/m/Y H:m', strtotime($uneReservation->getDateDebut())); ?>
                            </span></br>
                            <span class="infoLoca">
                                <i class="las la-calendar"></i><strong>Fin : </strong><?php echo date('d/m/Y H:m', strtotime($uneReservation->getDateFin())); ?>
                            </span>
                            <a href="?page=location&id=<?php echo $uneReservation->getAppartement()->getId(); ?>" class="bouton">Consulter</a>
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