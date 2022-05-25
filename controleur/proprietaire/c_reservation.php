<?php
/**
 * c_reservation.php
 * Description : Permet de gérer les réservations d'un appartement
 * @author : Valentin Marmié
 */
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ReservationManager.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeEtatManager.php';
require_once './modele/manager/ProprietaireManager.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Reservation.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeEtat.php';
require_once './modele/entite/Proprietaire.php';

use modele\manager\UtilisateurManager;
use modele\entite\Utilisateur;

use modele\manager\ReservationManager;
use modele\entite\Reservation;

use modele\manager\AppartementManager;
use modele\entite\Appartement;

use modele\manager\TypeEtatManager;
use modele\entite\TypeEtat;

use modele\manager\ProprietaireManager;
use modele\entite\Proprietaire;

$utilisateurManager = new UtilisateurManager();
$reservationManager = new ReservationManager();
$appartementManager = new AppartementManager();
$typeEtatManager = new TypeEtatManager();
$proprietaireManager = new ProprietaireManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(isset($authentification) && $authentification) {

    // Récupération de l'identifiant de l'appart
    $idAppart = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Vérification de la propriété de l'appartement
    $estProprietaire = $appartementManager->estProprietaire($idAppart, $_SESSION['utilisateur']['id']);

    // Récupération des états que le proprio peut appliquer
    $listeEtats = $typeEtatManager->getEtatsProp();

    if($estProprietaire) {

        // Récupération des infos utilisateurs
        $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);
        $proprietaire = $proprietaireManager->read($utilisateur->getId());

        // Récupération des infos de l'appartement
        $appartement = $appartementManager->read($idAppart);

        // Récupération des réservations d'un appart
        $reservations = $reservationManager->getReservationByIdAppart($idAppart);

        // Chargement des vues
        require_once './vue/elements/header.php';
        require_once './vue/proprietaire/v_reservation.php';

    } else {
        require_once './vue/elements/header.php';
        $titreErreur = "Problème de permission !";
        $msgErreur = "Vous n'avez pas le droit d'agir sur cet appartement.";
        $redirection = "proprietaire";
        $redirectionLibelle = "Retourner à l'espace propriétaire";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './controleur/c_connexion.php';
}