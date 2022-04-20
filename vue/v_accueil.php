<body>

    <div class="contenu">

        <aside class="infos">

            <div class="info">

                <div class="enteteInfo">
                    <h2>Bienvenue sur Locabis !</h2>
                </div>

                <div class="contenuInfo">
                    <p>Consultez dès aujourd'hui nos offres de location pour vos prochaines vacances.</p>
                </div>

            </div>

        </aside>
    
        <div class="page">

            <div class="entetePage">
                <h1>Nos locations</h1>
            </div>

            <?php if($afficheLocation != null) :?>
            <?php foreach ($afficheLocation as $laLocation) :?>

            <?php if ($nbCase === 0) :?>
            <div class="contenuCarte">
            <?php endif; ?>

                <div class="carteLoc">
                    <div class="carteLoc_entete">
                        <?php if (isset($laLocation->image)) :?>
                        <img src="http://172.24.2.143:8055/assets/<?php echo $laLocation->image ?>?width=342&height=222" alt="<?php echo $laLocation->idtype->libtype ?>">
                        <?php else :?>
                        <img src="./assets/img/appart.jpg" width="100%" alt="<?php echo $laLocation->LIBETYPE; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="carteLoc_contenu">
                        <h2><?php echo $laLocation->TITRE; ?></h2>
                        <span class="infoLoca">
                            <i class="las la-map-marker"></i><?php echo $laLocation->VILLE; ?>
                        </span>
                        <span class="infoLoca">
                            <i class="las la-home"></i><?php echo $laLocation->LIBETYPE; ?>
                        </span>
                        <a href="?page=location&id=<?php echo $laLocation->ID; ?>" class="bouton">Consulter</a>
                    </div>
                </div>
                
            <?php $nbCase++; ?>
            <?php if ($nbCase === 3) :?>
            </div>
            <?php $nbCase = 0;?>
            <?php endif; ?>
            <?php endforeach; ?>

            <?php else: ?>

                <p>Vous êtes arrivez jusqu'au bout !</p>

            <?php endif; ?>

            <nav>
                <ul class="pagination">
                    <?php if($pageCourante != 1):?>
                    <li>
                        <a href="?page=accueil&n=<?php echo $pageCourante - 1 ?>">Précédente</a>
                    </li>
                    <?php endif;?>

                    <?php if(isset($pageCourante) && $pageCourante != 1 && $afficheLocation != null) :?>
                    <li>
                        <a href="?page=accueil&n=<?php echo $pageCourante?>"><?php echo $pageCourante?></a>
                    </li>
                    <?php endif;?>

                    <?php if($afficheLocation != null && count($afficheLocation) > $locationParPage) :?>
                    <li>
                        <a href="?page=accueil&n=<?php echo $pageCourante + 1 ?>">Suivante</a>
                    </li>
                    <?php endif;?>
                </ul>
            </nav>

        </div>

    </div>