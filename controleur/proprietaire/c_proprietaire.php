<?php
/**
 * c_proprietaire.php
 * Description : Permet de récupérer les informations liées à l'espace propriétaire
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

    // Récupération des infos utilisateurs
    $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);
    $proprietaire = $proprietaireManager->read($utilisateur->getId());

    // Récupération des appartements
    $appartements = $appartementManager->getAppartementsByIdProp($proprietaire->getId());

    $nbCase = 0;

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/proprietaire/v_proprietaire.php';
} else {
    require_once './controleur/c_connexion.php';
}