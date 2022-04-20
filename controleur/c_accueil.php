<?php
// Fichier de base de données
require_once './modele/dao/dao.php';
require_once './modele/dao/appartement_dao.php';

$appartementDAO = new Appartement_DAO();

// Récupération numero page
if(isset($_GET['n']) && !empty($_GET['n']) && is_numeric($_GET['n'])) {
    $pageCourante = $_GET['n'];
} else {
    $pageCourante = 1;
}

// Système de pagination
// Connaitre le nombre d'appart
$nbLocations = $appartementDAO->getNbAppartements();

// Définition du nombre de page
$locationParPage = 9;
$pages = ceil($nbLocations/$locationParPage);

// Calcul première page
$premierePage = ($pageCourante * $locationParPage) - $locationParPage;

// Récupération des locations
$afficheLocation = $appartementDAO->getAppartements($premierePage, $locationParPage);
$nbCase = 0;

// Chargement des vues
require_once './vue/elements/header.php';
require_once './vue/v_accueil.php';
require_once './vue/elements/footer.php';