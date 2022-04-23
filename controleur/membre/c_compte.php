<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/entite/Utilisateur.php';

use modele\manager\UtilisateurManager;

$utilisateurManager = new UtilisateurManager();

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $authentification = $utilisateurManager->estConnecte();
}

if(isset($authentification) && $authentification) {

    // Récupération des infos utilisateurs
    $utilisateur = $utilisateurManager->read($_SESSION['utilisateur']['id']);

    // Vérification du jeton
    if(isset($_POST['jeton']) && $_POST['jeton'] === $_SESSION['jeton']) {


        // Mise à jour adresse mel
        if(isset($_POST['mel']) && !empty($_POST['mel'])) {

            // Récupération de la nouvelle donnée
            $nouvelAdresseMel = filter_input(INPUT_POST, 'mel', FILTER_SANITIZE_EMAIL);

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
        }

        // Mise à jour du mot de passe
        if(isset($_POST['motdepasse']) && !empty($_POST['motdepasse'])) {

            // Récupération de la nouvelle donnée
            $nouveauMotdepasse = filter_input(INPUT_POST, 'motdepasse', FILTER_SANITIZE_STRING);

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
        }

    }

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/membre/v_compte.php';
} else {
    require_once './controleur/c_connexion.php';
}