<?php
// Fichier de base de données
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/typeappart.php';

$appartementDAO = new Appartement_DAO();

if(
    isset($_GET['id']) &&
    !empty($_GET['id']) &&
    is_numeric($_GET['id'])
) {

    $idLocation = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération d'un appartement
    $appartement = $appartementDAO->getAppartementById($idLocation);
    $laLocation = new Appartement($appartement->ID, $appartement->IMAGE,$appartement->TITRE, $appartement->DESCRIPTION, $appartement->NUMERO, $appartement->ETAGE);

    // Récupération type appart
    $typeAppart = $appartementDAO->getTypeAppart($idLocation);
    $typeLocation = new TypeAppart((int)$typeAppart->ID, $typeAppart->LIBETYPE, $typeAppart->TARIFLOCABASE);
    var_dump($typeLocation);

    // Chargements des vues
    require_once './vue/elements/header.php';
    if($laLocation) {
        require_once './vue/v_location.php';
    } else {
        $titreErreur = "Location innexistante !";
        $msgErreur = "La location recherché est innexistante ou a été retiré.";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './vue/v_accueil.php';
}

require_once './vue/elements/footer.php';