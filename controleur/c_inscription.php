<?php
// Chargement des managers
require_once './modele/manager/ManagerPrincipal.php';
require_once './modele/manager/UtilisateurManager.php';
require_once './modele/entite/Utilisateur.php';

use modele\manager\UtilisateurManager;
use modele\entite\Utilisateur;

$utilisateurManager = new UtilisateurManager();

// Récupération des données
if(
    isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['mel']) && !empty($_POST['mel'])
    && isset($_POST['motDePasse']) && !empty($_POST['motDePasse'])
) {

    // Filtrage des données
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $adresseMel = filter_input(INPUT_POST, 'mel', FILTER_SANITIZE_EMAIL);
    $motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING);

    // Création de l'utilisateur
    $utilisateur = new Utilisateur();
    $utilisateur->setMel($adresseMel);
    $utilisateur->setPrenom($prenom);
    $utilisateur->setNom($nom);
    $utilisateur->setMotDePasse($motDePasse);

    // Vérification de l'adresse mel
    $verifMel = $utilisateurManager->verifMel($utilisateur);

    if($verifMel) {

        $createSucces = $utilisateurManager->create($utilisateur);

        // Connexion dès lorsque l'inscription à aboutie
        if($createSucces) {

            $authentification = $utilisateurManager->connexion($utilisateur);

            if($authentification) {

                session_start();
                $_SESSION['utilisateur']['id'] = $authentification['id'];
                $_SESSION['utilisateur']['mel'] = $authentification['mel'];
                $_SESSION['utilisateur']['motDePasse'] = $authentification['motDePasse'];
                $_SESSION['jeton'] = bin2hex(openssl_random_pseudo_bytes(6));

                header('Location:?page=membre');

            }

        }

    } else {
        $msgErreur = "Adresse mél déjà utilisé !";
    }

}

// Fichiers de vues
require_once './vue/elements/header.php';
if(!isset($_SESSION['utilisateur']) && !isset($_SESSION['jeton'])) {
    require_once './vue/v_inscription.php';
} else {
    header('Location:?page=membre');
}
require_once './vue/elements/footer.php';