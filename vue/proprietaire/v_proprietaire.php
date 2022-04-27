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
            <h1>Vos appartements</h1>
        </div>

        <div class="contenuPage">

            <?php if(empty($appartements)): ?>
                <p>Vous n'avez réaliser aucunes réservations.</p>
            <?php
            else :
                foreach ($appartements as $appartement) :
                    ?>

                    <?php if ($nbCase === 0) :?>
                    <div class="contenuCarte">
                <?php endif; ?>

                    <div class="carteLoc">
                        <div class="carteLoc_contenu">
                            <h2><?php echo $appartement->titre; ?></h2>
                            <span class="infoLoca">
                            <i class="las la-map-marker"></i><?php echo $appartement->ville; ?>
                        </span></br>
                            <span class="infoLoca">
                            <i class="las la-home"></i><?php echo $appartement->libetype; ?>
                        </span>
                            <a href="?page=appartement&id=<?php echo $appartement->id; ?>" class="bouton">Gérer</a>
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