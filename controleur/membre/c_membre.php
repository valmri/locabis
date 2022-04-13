<?php
if(estConnecte()) {
    // Fichiers par défaut
    require_once './vue/elements/header.php';

    // Récupération des infos utilisateurs 
    $infos = getInfosUtilisateur($_SESSION['identifiant']);
    $dateConnexion = strtotime($infos->derniere_connexion);
    $derniereConnexion = date('d/m/Y H:m', $dateConnexion);

    require_once './vue/membre/v_membre.php';
} else {
    require_once './controleur/c_connexion.php';
}