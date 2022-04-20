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
                <h1>Bienvenue dans votre espace !</h1>
            </div>

            <div class="contenuPage">

                <p>Vous n'avez réaliser aucunes réservations.</p>

            </div>

        </div>

    </div>