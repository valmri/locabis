<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeAppartManager.php';
require_once './modele/manager/ImmeubleManager.php';
require_once './modele/manager/EquipementManager.php';
require_once './modele/manager/AvisManager.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeAppart.php';
require_once './modele/entite/Immeuble.php';
require_once './modele/entite/Equipement.php';
require_once './modele/entite/Avis.php';

use modele\manager\AppartementManager;
use modele\entite\Appartement;

use modele\manager\TypeAppartManager;
use modele\entite\TypeAppart;

use modele\manager\ImmeubleManager;
use modele\entite\Immeuble;

use modele\manager\EquipementManager;
use modele\entite\Equipement;

use modele\manager\AvisManager;
use modele\entite\Avis;

$appartementManager = new AppartementManager();
$typeAppartManager = new TypeAppartManager();
$immeubleManager = new ImmeubleManager();
$equipementManager = new EquipementManager();
$avisManager = new AvisManager();

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

    // Récupération des équipements de l'appartement
    $estEquipe = $equipements = $equipementManager->getEquipementsByIdAppart($appartement->getId());
    if($estEquipe) {
        $appartement->setEquipements($equipements);
    }

    // Récupération des avis
    $lesAvis = $avisManager->getAvisByIdAppart($appartement->getId());
    if($lesAvis) {
        $appartement->setAvis($lesAvis);
    }


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