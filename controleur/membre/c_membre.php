<?php
// Fichier de base de données
require_once './modele/dao/dao.php';
require_once './modele/dao/authentification_dao.php';
require_once './modele/entite/utilisateur.php';

// Vérification de l'authentification
if(isset($_SESSION['utilisateur']) && isset($_SESSION['jeton'])) {
    $unUtilisateur = new Authentification($_SESSION['utilisateur']['MEL'], $_SESSION['utilisateur']['MOTDEPASSE']);
    $autorisation = $unUtilisateur->estConnecte();
}

if(isset($autorisation) && $autorisation) {

    // Récupération des infos utilisateurs
    $utilisateur = $unUtilisateur->getUtilisateur();
    $dateConnexion = strtotime($utilisateur->getDerniereConnexion());
    $derniereConnexion = date('d/m/Y H:m', $dateConnexion);

    // Chargement des vues
    require_once './vue/elements/header.php';
    require_once './vue/membre/v_membre.php';
} else {
    require_once './controleur/c_connexion.php';
}