<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ReservationManager.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeEtatManager.php';
require_once './modele/manager/AvisManager.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Reservation.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeEtat.php';
require_once './modele/entite/Avis.php';

use modele\manager\UtilisateurManager;
use modele\entite\Utilisateur;

use modele\manager\ReservationManager;
use modele\entite\Reservation;

use modele\manager\AppartementManager;
use modele\entite\Appartement;

use modele\manager\TypeEtatManager;
use modele\entite\TypeEtat;

use modele\manager\AvisManager;
use modele\entite\Avis;

$utilisateurManager = new UtilisateurManager();
$reservationManager = new ReservationManager();
$appartementManager = new AppartementManager();
$typeEtatManager = new TypeEtatManager();
$avisManager = new AvisManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(
    isset($authentification)
    && $authentification
    && isset($_GET['id'])
    && !empty($_GET['id'])
    && is_numeric($_GET['id'])
) {

    // Récupération des infos utilisateurs
    $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);

    // Récupération de l'identifiant de l'avis
    $idAvis = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Vérification de la propriété de l'avis
    $verifProprio = $avisManager->verifPropAvisByIdAvis($idAvis, $utilisateur->getId());
    if($verifProprio) {

        // Récupération des données de l'avis
        $avis = $avisManager->read($idAvis);

        // Récupération du commentaire modifier
        if(
            isset($_POST['commentaire'])
            && !empty($_POST['commentaire'])
            && isset($_POST['note'])
            && !empty($_POST['note']
                && isset($_POST['jeton']))
        ) {

            // Contrôle du jeton
            if($_POST['jeton'] && $_POST['jeton'] === $_SESSION['jeton']) {

                if(is_numeric($_POST['note'])) {

                    if($_POST['note'] >= 0 && $_POST['note'] <= 5) {

                        // Nettoyage du commentaire
                        $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
                        $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

                        // Mise à jour du commentaire
                        $avis->setNote($note);
                        $avis->setCommentaire($commentaire);
                        $avis->setReservation($idAvis);
                        $majSucces = $avisManager->update($avis);

                        if($majSucces) {
                            $msgInfo = "Commentaire mis à jour !";
                        } else {
                            $msgErreur = "Erreur lors de la mise à jour.";
                        }

                    } else {
                        $msgErreur = "La note soit être comprise entre 0 et 5.";
                    }

                } else {
                    $msgErreur = "Veuillez saisir un entier.";
                }

            } else {
                header("Location:?page=deconnexion");
            }

        }

        // Chargement des vues
        require_once './vue/elements/header.php';
        require_once './vue/membre/v_avis.php';
    } else {
        require_once './vue/elements/header.php';
        $titreErreur = "Permission insufisante !";
        $msgErreur = "Vous n'avez pas l'autorisation d'agir sur cet avis.";
        $redirection = "accueil";
        $redirectionLibelle = "Retourner à l'accueil";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './controleur/c_connexion.php';
}