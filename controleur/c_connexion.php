<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/entite/Utilisateur.php';

use modele\manager\UtilisateurManager;

$utilisateurManager = new UtilisateurManager();

// Récupération des données
if(
    isset($_POST['identifiant']) &&
    isset($_POST['motDePasse']) &&
    !empty($_POST['identifiant']) &&
    !empty($_POST['motDePasse'])
) {

    // Nettoyage des données
    $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
    $motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING);

    $utilisateur = new \modele\entite\Utilisateur();
    $utilisateur->setMel($identifiant);
    $utilisateur->setMotDePasse($motDePasse);

    $authentification = $utilisateurManager->connexion($utilisateur);

    if($authentification) {

        session_start();
        $_SESSION['utilisateur']['id'] = $authentification['id'];
        $_SESSION['utilisateur']['mel'] = $authentification['mel'];
        $_SESSION['utilisateur']['motDePasse'] = $authentification['motDePasse'];
        $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));

        header('Location:?page=membre');

    } else {
        $msgErreur = "Identifant ou mot de passe incorrect !";
    }


}

// Fichiers de vues
require_once './vue/elements/header.php';
if(!estConnecte()) {
    require_once './vue/v_connexion.php';
}
require_once './vue/elements/footer.php';