<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ReservationManager.php';
require_once './modele/manager/AppartementManager.php';
require_once './modele/manager/TypeEtatManager.php';
require_once './modele/manager/ProprietaireManager.php';
require_once './modele/manager/EquipementManager.php';
require_once './modele/manager/EquipementAppartementManager.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Reservation.php';
require_once './modele/entite/Appartement.php';
require_once './modele/entite/TypeEtat.php';
require_once './modele/entite/Proprietaire.php';
require_once './modele/entite/Equipement.php';
require_once './modele/entite/EquipementAppartement.php';

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

use modele\manager\EquipementManager;
use modele\entite\Equipement;

use modele\manager\EquipementAppartementManager;
use modele\entite\EquipementAppartement;

$utilisateurManager = new UtilisateurManager();
$reservationManager = new ReservationManager();
$appartementManager = new AppartementManager();
$typeEtatManager = new TypeEtatManager();
$proprietaireManager = new ProprietaireManager();
$equipementManager = new EquipementManager();
$equipementAppartManager = new EquipementAppartementManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(isset($authentification) && $authentification) {

    // Récupération de l'identifiant de l'appart
    $idAppart = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération des infos de l'appartement
    $appartement = $appartementManager->read($idAppart);

    // Récupération de la liste des équipements
    $listeEquipements = $equipementManager->readAll();

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
                $msgInfo = "Modifiée avec succès !";
            } else {
                $msgErreur = "Erreur lors de la modification de la description.";
            }

        }

        if(isset($_POST['equipements']) && !empty($_POST['equipements'])) {

            // Récupération des données
            $lesEquipements = $_POST['equipements'];
            foreach ($lesEquipements as $unEquipement) {

                if(isset($unEquipement['id']) && $unEquipement['quantite'] > 0 && is_numeric($unEquipement['quantite'])) {

                    // Nettoyage des données du formulaire
                    $idPropre = filter_var($unEquipement['id'], FILTER_SANITIZE_NUMBER_INT);
                    $quantitePropre = filter_var($unEquipement['quantite'], FILTER_SANITIZE_NUMBER_INT);

                    // Initialisation d'un equipement
                    $equipementPropre = new EquipementAppartement();
                    $equipementPropre->setIdAppartement($idAppart);
                    $equipementPropre->setIdEquipement($idPropre);
                    $equipementPropre->setQuantite($quantitePropre);

                    /**
                     * Vérification d'un équipement existant dans un appart
                     * Si true -> update
                     * Sinon -> create
                     */
                    $equipementExiste = $equipementAppartManager->existe($idAppart, $idPropre);
                    if($equipementExiste) {
                        $equipementAppartManager->update($equipementPropre);
                    } else {
                        $equipementAppartManager->create($equipementPropre);
                    }

                } elseif(isset($unEquipement['id']) && $unEquipement['quantite'] == 0) {

                    // Nettoyage des données du formulaire
                    $idPropre = filter_var($unEquipement['id'], FILTER_SANITIZE_NUMBER_INT);
                    $quantitePropre = filter_var($unEquipement['quantite'], FILTER_SANITIZE_NUMBER_INT);

                    // Initialisation d'un equipement
                    $equipementPropre = new EquipementAppartement();
                    $equipementPropre->setIdAppartement($idAppart);
                    $equipementPropre->setIdEquipement($idPropre);

                    $equipementExiste = $equipementAppartManager->existe($idAppart, $idPropre);
                    if($equipementExiste) {
                        $equipementAppartManager->delete($equipementPropre);
                    }

                }

            }

        }

        // Suppression des éléments décochés
        if(isset($_POST['equipementsSuppr']) && !empty($_POST['equipementsSuppr'])) {

            $equipementsSuppr = $_POST['equipementsSuppr'];

            foreach ($equipementsSuppr as $equipement) {

                // Nettoyage de l'identifiant de l'équipement
                (int)$idEquipement = filter_var($equipement, FILTER_SANITIZE_NUMBER_INT);

                if(is_numeric($idEquipement)) {

                    // Vérification de l'existance de l'équipement dans l'appartement
                    $equipementExiste = $equipementAppartManager->existe($idAppart, $idEquipement);

                    if($equipementExiste) {

                        // Suppression de l'équipement d'un appartement
                        $equipement = new EquipementAppartement();
                        $equipement->setIdAppartement($idAppart);
                        $equipement->setIdEquipement($idEquipement);
                        $equipementAppartManager->delete($equipement);

                    }
                }


            }
        }

        // Récupération des équipements de l'appartement
        $equipements = $equipementManager->getEquipementsByIdAppart($idAppart);

        // Compteur pour affichage
        $compteur = 0;

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