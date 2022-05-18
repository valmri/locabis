<header>
    <div class="menu">
        <span class="logo">
            <a href="?page=accueil"></a>
        </span>
        <nav class="navigation">

            <div class="boutonNavigations">
                <ul>
                    <li>
                        <a class="boutonMenu" href="?page=accueil">Accueil</a>
                    </li>
                </ul>
            </div>

            <div class="boutonConnecte">
                <ul>
                    <?php if (!isset($_SESSION['utilisateur']) && !isset($_SESSION['jeton'])) :?>
                    <li>
                        <a class="boutonMenu" href="?page=inscription">Inscription</a>
                    </li>
                    <li>
                        <a class="boutonMenu" href="?page=connexion">Connexion</a>
                    </li>
                    <?php else :?>
                        <li>
                            <a class="boutonMenu" href="?page=membre">Espace membre</a>
                        </li>
                    <?php if(isset($_SESSION['utilisateur']['role']) && (int)$_SESSION['utilisateur']['role'] === 2) : ?>
                        <li>
                            <a class="boutonMenu" href="?page=proprietaire">Espace proprietaire</a>
                        </li>
                    <?php endif; ?>
                        <li>
                            <a class="boutonMenu" href="?page=deconnexion">Déconnexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            
        </nav>
    </div>
</header>