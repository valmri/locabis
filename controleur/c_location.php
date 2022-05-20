<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeAppartManager.php';
require_once './modele/manager/ImmeubleManager.php';
require_once './modele/manager/EquipementManager.php';
require_once './modele/manager/AvisManager.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ReservationManager.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeAppart.php';
require_once './modele/entite/Immeuble.php';
require_once './modele/entite/Equipement.php';
require_once './modele/entite/Avis.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Reservation.php';

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

use modele\manager\UtilisateurManager;
use modele\entite\Utilisateur;

use modele\manager\ReservationManager;
use modele\entite\Reservation;

$appartementManager = new AppartementManager();
$typeAppartManager = new TypeAppartManager();
$immeubleManager = new ImmeubleManager();
$equipementManager = new EquipementManager();
$avisManager = new AvisManager();
$utilisateurManager = new UtilisateurManager();
$reservationManager = new ReservationManager();

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

    // Vérification de l'authentification
    if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
        $authentification = $utilisateurManager->estConnecte();
    }

    // Récupération de l'utilisateur
    if(isset($authentification) && $authentification) {

        // Récupératop, de l'utilisateur
        $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);

        // Récupération d'une réservation
        $reservation = $reservationManager->getReservationForAvis($utilisateur->getId(), $idAppartement);

        // Vérification de l'existence d'une réservation
        if($reservation) {

            // Vérification de l'existance d'un avis
            $avisExiste = $avisManager->verifAvis($utilisateur->getId(), $appartement->getId());

            if(!$avisExiste) {
                // Création d'un avis
                if(
                    isset($_POST['note'])
                    && isset($_POST['commentaire'])
                    && !empty($_POST['note'])
                    && !empty($_POST['commentaire'])
                ) {

                    if(is_numeric($_POST['note'])) {

                        if( $_POST['note'] >= 0 && $_POST['note'] <= 5) {

                            // Nettoyage des valeurs
                            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
                            $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

                            // Enregistrement de l'avis
                            $avis = new Avis();
                            $avis->setReservation($reservation->getId());
                            $avis->setUtilisateur($utilisateur->getId());
                            $avis->setAppartement($idAppartement);
                            $avis->setNote($note);
                            $avis->setCommentaire($commentaire);

                            $avisManager->create($avis);

                            // Modification de l'état d'une réservation
                            $reservation->setEtat(5);
                            $reservationManager->updateEtat($reservation);

                            $msgInfo = "Votre avis a bien été enregistré !";

                        } else {
                            $msgErreur = "La note doit être inférieure ou égale à 5.";
                        }
                    } else {
                        $msgErreur = "La note doit être un entier.";
                    }

            }

        }

        }

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
        $redirection = "accueil";
        $redirectionLibelle = "Retourner à l'accueil";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './vue/v_accueil.php';
}

require_once './vue/elements/footer.php';