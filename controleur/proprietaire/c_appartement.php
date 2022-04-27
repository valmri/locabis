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

    // Récupération de l'identifiant de l'appart
    $idAppart = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération des infos de l'appartement
    $appartement = $appartementManager->read($idAppart);

    // Récupération des équipements de l'appartement
    // TODO : Faire système pour éditer et ajouter des équipements

    // Vérification du propriétaire de l'appartement
    if($appartement && (int)$_SESSION['utilisateur']['id'] === $appartement->getProprietaire()) {

        // Récupération des données
        if(isset($_POST['titre']) && !empty($_POST['titre'])) {

            // Nettoyage
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);

            // Màj
            $appartement->setTitre($titre);
            $majSucces = $appartementManager->update($appartement);

            if($majSucces) {
                $msgInfo = "Titre modifié avec succès !";
            } else {
                $msgErreur = "Erreur lors de la modification du titre.";
            }

        }

        if(isset($_POST['description']) && !empty($_POST['description'])) {

            // Nettoyage
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            // Màj
            $appartement->setDescription($description);
            $majSucces = $appartementManager->update($appartement);

            if($majSucces) {
                $msgInfo = "Description modifiée avec succès !";
            } else {
                $msgErreur = "Erreur lors de la modification de la description.";
            }

        }

        // Chargement des vues
        require_once './vue/elements/header.php';
        require_once './vue/proprietaire/v_appartement.php';
    } else {
        require_once './vue/elements/header.php';
        $titreErreur = "Problème de permission !";
        $msgErreur = "Vous n'avez pas l'autorisation de modifier cet appartement.";
        $redirection = "proprietaire";
        $redirectionLibelle = "Retourner à l'espace propriétaire";
        require_once './vue/elements/erreur.php';
    }

} else {
    require_once './controleur/c_connexion.php';
}