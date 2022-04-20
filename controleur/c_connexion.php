<?php
// Fichier de base de données
require_once './modele/dao/dao.php';
require_once './modele/dao/authentification_dao.php';
require_once './modele/entite/utilisateur.php';

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

    $authentification = new Authentification($identifiant,$motDePasse);
    $utilisateur = $authentification->connexion();

    if($utilisateur) {

        session_start();
        $_SESSION['utilisateur'] = $utilisateur;
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