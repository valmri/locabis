<?php
// Fichier de base de données
require_once './modele/dao/dao.php';
require_once './modele/dao/authentification_dao.php';
require_once './modele/dao/utilisateur_dao.php';
require_once './modele/dao/reservation_dao.php';
require_once './modele/entite/utilisateur.php';
require_once './modele/entite/reservation.php';
require_once './modele/entite/appartement.php';

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = new Authentification($_SESSION['utilisateur']['MEL'], $_SESSION['utilisateur']['MOTDEPASSE']);
    $autorisation = $authentification->estConnecte();
}

if(isset($autorisation) && $autorisation) {

    // Récupération des infos utilisateurs
    $utilisateurDAO = new Utilisateur_DAO();
    $utilisateur = $utilisateurDAO->getUtilisateur($_SESSION['utilisateur']['ID']);
    $dateConnexion = strtotime($utilisateur->getDerniereConnexion());
    $derniereConnexion = date('d/m/Y H:m', $dateConnexion);

    // Récupération des réservations
    $reservationDAO = new Reservation_DAO();
    $reservations = $reservationDAO->getReservationByUserId($utilisateur->getId());
    foreach ($reservations as $uneReservation) {
        $appartAjoute = new Appartement($uneReservation->ID_APPARTEMENT, $uneReservation->IMAGE,$uneReservation->TITRE, $uneReservation->DESCRIPTION, $uneReservation->NUMERO, $uneReservation->ETAGE);
        $reservationAjoutee = new Reservation($uneReservation->ID, $uneReservation->DATE_DEBUT, $uneReservation->DATE_FIN, $appartAjoute);
        $utilisateur->addReservation($reservationAjoutee);
    }

    $reservationsUtilisateur = $utilisateur->getReservations();

    $nbCase = 0;

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/membre/v_membre.php';
} else {
    require_once './controleur/c_connexion.php';
}