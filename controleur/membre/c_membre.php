<?php
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

    // Récupération des infos utilisateurs
    $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);

    // Récupération des réservations
    $reservations = $reservationManager->readAll($utilisateur->getId());
    var_dump($reservations[0]);
    $collectionReservation = new \Ds\Vector();
    foreach ($reservations as $reservation) {

        $uneReservation = new \Ds\Vector();

        $uneReservation->push($reservation);

        // Récupération des appartements attachés aux réservations
        $appart = $appartementManager->read($reservation->getAppartement());

        $uneReservation->push($appart);

        // Récupération des états des réservations
        $etat = $typeEtatManager->read($reservation->getEtat());

        $uneReservation->push($etat);

        $collectionReservation->push($uneReservation);

    }

    // Vérification rôle propriétaire
    if ($utilisateur->getRole() === 2) {

        // Récupération infos proprietaire
        $proprietaire = $proprietaireManager->read($utilisateur->getId());

    }

    $nbCase = 0;

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/membre/v_membre.php';
} else {
    require_once './controleur/c_connexion.php';
}