<body>

    <div class="contenu">
    
        <div class="page">
            
            <div>

                <div class="recherche">
                    <p>Recherche :</p>

                    <form action="#" method="post">

                        <label for="ville">Ville :</label>
                        <select id="ville" name="ville">

                            <?php foreach($lesVilles as $uneVille): ?>
                                <option onclick="getAppartByVille(this.value)" value="<?= $uneVille['ville'] ?>"><?= $uneVille['ville'] ?></option>
                            <?php endforeach; ?>

                        </select>

                    </form>
                </div>

            <div class="entetePage">
                <h1>Nos locations</h1>
            </div>
                
            <div id="lesContenus">

            <?php if($afficheLocation != null) :?>
            <?php foreach ($afficheLocation as $laLocation) :?>

            <?php if ($nbCase === 0) :?>
            <div id="contenu" class="contenuCarte">
            <?php endif; ?>

                <div class="carteLoc">
                    <div class="carteLoc_entete">
                        <?php if ($laLocation->photo != null) :?>
                            <img src="./images/apparts/<?php echo $laLocation->photo; ?>.jpg" width="100%" alt="<?php echo $laLocation->libetype; ?>">
                        <?php else :?>
                        <img src="./assets/img/appart.jpg" width="100%" alt="<?php echo $laLocation->libetype; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="carteLoc_contenu">
                        <h2><?php echo $laLocation->titre; ?></h2>
                        <span class="infoLoca">
                            <i class="las la-map-marker"></i><?php echo $laLocation->ville; ?>
                        </span></br>
                        <span class="infoLoca">
                            <i class="las la-home"></i><?php echo $laLocation->libetype; ?>
                        </span>
                        <a href="?page=location&id=<?php echo $laLocation->id; ?>" class="bouton">Consulter</a>
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