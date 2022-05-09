<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/manager/ProprietaireManager.php';
require_once './modele/entite/Utilisateur.php';
require_once './modele/entite/Proprietaire.php';

use modele\manager\UtilisateurManager;
use modele\manager\ProprietaireManager;
use modele\entite\Utilisateur;

$utilisateurManager = new UtilisateurManager();
$proprietaireManager = new ProprietaireManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(isset($authentification) && $authentification) {

    // Récupération des infos utilisateurs
    $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);

    // Vérification du role
    if($utilisateur->getRole() === 2) {

        // Récupération infos proprio
        $proprietaire = $proprietaireManager->read($utilisateur->getId());

    }

    // Vérification du jeton
    if(isset($_POST['jeton']) && $_POST['jeton'] === $_SESSION['jeton']) {


        // Mise à jour adresse mel
        if(isset($_POST['mel']) && !empty($_POST['mel'])) {

            // Récupération de la nouvelle donnée
            $nouvelAdresseMel = filter_input(INPUT_POST, 'mel', FILTER_VALIDATE_EMAIL);

            // Vérification de la conformité de l'adresse mel
            if($nouvelAdresseMel) {

                // Modification de l'objet
                $utilisateur->setMel($nouvelAdresseMel);

                // Mise à jour en base de donnée avec le manager
                $majSucces = $utilisateurManager->updateMel($utilisateur);

                // Vérification de la mise à jour
                if($majSucces) {

                    // Modification variable de session pour maintenir la session active
                    $_SESSION['utilisateur']['mel'] = $nouvelAdresseMel;
                    $msgInfo = "Adresse mel modifié avec succès !";

                } else {
                    $msgErreur = "Erreur lors de la mise à jour de l'adresse mel.";
                }
            } else {
                $msgErreur = "Adresse mel non valide.";
            }

        }

        // Mise à jour du mot de passe
        if(
            isset($_POST['motdepasse']) && !empty($_POST['motdepasse'])
            && isset($_POST['motdepasseConf']) && !empty($_POST['motdepasseConf'])
        ) {

            // Récupération de la nouvelle donnée
            $nouveauMotdepasse = filter_input(INPUT_POST, 'motdepasse', FILTER_SANITIZE_STRING);
            $motDePasseConfirme = filter_input(INPUT_POST, 'motdepasseConf', FILTER_SANITIZE_STRING);

            // Vérification du mot de passe
            if($nouveauMotdepasse === $motDePasseConfirme) {

                // Modification de l'objet
                $nouveauMotdepasseHache = password_hash($nouveauMotdepasse, PASSWORD_BCRYPT);
                $utilisateur->setMotDePasse($nouveauMotdepasseHache);

                // Mise à jour en base de donnée avec le manager
                $majSucces = $utilisateurManager->updateMotDePasse($utilisateur);

                // Vérification de la mise à jour
                if($majSucces) {

                    // Modification variable de session pour maintenir la session active
                    $_SESSION['utilisateur']['motDePasse'] = $nouveauMotdepasse;
                    $msgInfo = "Mot de passe modifié avec succès !";

                } else {
                    $msgErreur = "Erreur lors de la mise à jour du mot de passe.";
                }

            } else {
                $msgErreur = "Le mot de passe confirmé est différent du mot de passe choisi.";
            }

        }

        // Vérification du rôle
        if($utilisateur->getRole() === 2) {

            // Modification adresse
            if(isset($_POST['adresse']) && !empty($_POST['adresse'])) {

                // Nettoyage
                $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);

                // Màj
                $proprietaire->setAdresse($adresse);

                $proprietaireManager->update($proprietaire);

            }

            // Modification ville
            if(isset($_POST['ville']) && !empty($_POST['ville'])) {

                // Nettoyage
                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);

                // Màj
                $proprietaire->setVille($ville);
                $proprietaireManager->update($proprietaire);

            }

            if(isset($_POST['telephone']) && !empty($_POST['telephone'])) {

                // Nettoyage
                $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);

                // Maj
                $proprietaire->setTelephone($telephone);
                $proprietaireManager->update($proprietaire);

            }

        }

    }

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/membre/v_compte.php';
} else {
    require_once './controleur/c_connexion.php';
}