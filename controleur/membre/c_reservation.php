<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ReservationManager.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeAppartManager.php';
require_once './modele/manager/ImmeubleManager.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Reservation.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeAppart.php';
require_once './modele/entite/Immeuble.php';

use modele\manager\UtilisateurManager;
use modele\entite\Utilisateur;

use modele\manager\ReservationManager;
use modele\entite\Reservation;

use modele\manager\AppartementManager;
use modele\entite\Appartement;

use modele\manager\TypeAppartManager;
use modele\entite\TypeAppart;

use modele\manager\ImmeubleManager;
use modele\entite\Immeuble;

$utilisateurManager = new UtilisateurManager();
$reservationManager = new ReservationManager();
$appartementManager = new AppartementManager();
$typeAppartManager = new TypeAppartManager();
$immeubleManager = new ImmeubleManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(isset($authentification) && $authentification) {

    if(
        isset($_GET['id']) &&
        !empty($_GET['id']) &&
        is_numeric($_GET['id'])
    ) {
    
        // Récupération des données
        $idLocation = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $idUtilisateur = $_SESSION['utilisateur']['id'];
    
        // Récupération des informations de la location
        $laLocation = $appartementManager->read($idLocation);

        // Récupération du type
        $type = $typeAppartManager->read($laLocation->getType());
        $laLocation->setType($type);

        // Récupération de l'immeuble
        $immeuble = $immeubleManager->read($laLocation->getImmeuble());
        $laLocation->setImmeuble($immeuble);

        if(
            isset($_POST['dateDebut']) &&
            isset($_POST['dateFin']) &&
            isset($_POST['heureDebut']) &&
            isset($_POST['heureFin']) &&
            !empty($_POST['dateDebut']) &&
            !empty($_POST['dateFin']) &&
            !empty($_POST['heureDebut']) &&
            !empty($_POST['heureFin'])
        ) {

            // Nettoyage des données
            $dateDebut = filter_input(INPUT_POST, 'dateDebut', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateFin = filter_input(INPUT_POST, 'dateFin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $heureDebut = filter_input(INPUT_POST, 'heureDebut', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $heureFin = filter_input(INPUT_POST, 'heureFin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $reservation = new Reservation();

            $reservation->setUtilisateur($idUtilisateur);
            $reservation->setAppartement($idLocation);
            $reservation->setDateDebut($dateDebut.' '.$heureDebut);
            $reservation->setDateFin($dateFin.' '.$heureFin);
            $reponse = $reservationManager->create($reservation);

            if($reponse) {
                $msgInfo = "Réservation effectuée avec succès !";
            } else {
                $msgErreur = "Erreur lors de la réservation.";
            }

        }

        // Chargement des vues
        require_once './vue/elements/header.php';
        if($laLocation) {
            require_once './vue/membre/v_reservation.php';
        } else {
            $titreErreur = "Location innexistante !";
            $msgErreur = "La location recherché est innexistante ou a été retiré.";
            require_once './vue/elements/erreur.php';
        }
    
    } else {
        require_once './vue/v_accueil.php';
    }

} else {
    require_once './controleur/c_connexion.php';
}