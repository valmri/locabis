<?php
/**
 * controleurPrincipal.php
 * Description : Permet de diriger les usagers sur les différentes pages
 * @author : Valentin Marmié
 */
function controleur(string $page) {

    // Définition du tableau des directions
    $actions = array();
    $actions['accueil'] = 'c_accueil.php';
    $actions['connexion'] = 'c_connexion.php';
    $actions['membre'] = 'membre/c_membre.php';
    $actions['deconnexion'] = 'membre/c_deconnexion.php';
    $actions['compte'] = 'membre/c_compte.php';
    $actions['inscription'] = 'c_inscription.php';

    // Contrôle de l'existance d'un identifiant
    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
        $actions['location'] = 'c_location.php';
        $actions['reserver'] = 'membre/c_reservation.php';
        $actions['avis'] = 'membre/c_avis.php';
    }

    // Redirection pour les propriétaires
    if(isset($_SESSION['utilisateur']['role']) && (int)$_SESSION['utilisateur']['role'] === 2) {
        $actions['proprietaire'] = 'proprietaire/c_proprietaire.php';

        if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
            $actions['appartement'] = 'proprietaire/c_appartement.php';
            $actions['reservation'] = 'proprietaire/c_reservation.php';
        }

    }
    
    
    if(array_key_exists($page, $actions)) {

        $resultat = $actions[$page];

    } else {

        $resultat = $actions['accueil'];

    }

    return $resultat;

}
