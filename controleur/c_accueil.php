<?php
/**
 * c_accueil.php
 * Description : Permet de récupérer les informations liées à la page d'accueil
 * @author : Valentin Marmié
 */
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeAppartManager.php';
require_once './modele/manager/ImmeubleManager.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeAppart.php';
require_once './modele/entite/Immeuble.php';

use modele\manager\AppartementManager;

$appartementManager = new AppartementManager();

// Récupération numero page
if(isset($_GET['n']) && !empty($_GET['n']) && is_numeric($_GET['n'])) {
    $pageCourante = $_GET['n'];
} else {
    $pageCourante = 1;
}

// Système de pagination
// Connaitre le nombre d'appart
$nbLocations = $appartementManager->getNbAppartements();

// Définition du nombre de page
$locationParPage = 9;
$pages = ceil($nbLocations/$locationParPage);

// Calcul première page
$premierePage = ($pageCourante * $locationParPage) - $locationParPage;

// Récupération des locations
$afficheLocation = $appartementManager->getAppartements($premierePage, $locationParPage);
$nbCase = 0;

// Chargement des vues
require_once './vue/elements/header.php';
require_once './vue/v_accueil.php';
require_once './vue/elements/footer.php';