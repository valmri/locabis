<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeAppartManager.php';
require_once './modele/manager/ImmeubleManager.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeAppart.php';
require_once './modele/entite/Immeuble.php';

use modele\manager\AppartementManager;
use modele\entite\Appartement;

use modele\manager\TypeAppartManager;
use modele\entite\TypeAppart;

use modele\manager\ImmeubleManager;
use modele\entite\Immeuble;

$appartementManager = new AppartementManager();
$typeAppartManager = new TypeAppartManager();
$immeubleManager = new ImmeubleManager();

if(
    isset($_GET['id']) &&
    !empty($_GET['id']) &&
    is_numeric($_GET['id'])
) {

    $idAppartement = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération d'un appartement
    $appartement = $appartementManager->read($idAppartement);
    if($appartement) {

    // Récupération du type d'appart
    $type = $typeAppartManager->read($appartement->getType());
    $appartement->setType($type);

    // Récupération de l'immeuble
    $immeuble = $immeubleManager->read($appartement->getImmeuble());
    $appartement->setImmeuble($immeuble);

    // Chargements des vues
    require_once './vue/elements/header.php';
    require_once './vue/v_location.php';
    } else {
        require_once './vue/elements/header.php';
        $titreErreur = "Location innexistante !";
        $msgErreur = "La location recherché est innexistante ou a été retiré.";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './vue/v_accueil.php';
}

require_once './vue/elements/footer.php';