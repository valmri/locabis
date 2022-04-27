<body>

    <div class="contenu">

        <div class="page">

            <div class="entetePage">
                <h1><?= $titreErreur; ?></h1>
            </div>

            <div class="contenuPage">
                <p><?= $msgErreur; ?></p>
                <a href="?page=<?= $redirection ?>" class="bouton"><?= $redirectionLibelle ?></a>
            </div>

        </div>

    </div>