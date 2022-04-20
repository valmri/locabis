<?php
// Autoloader de composer
require_once './vendor/autoload.php';

// Fichier par défaut
require_once './modele/fonctions.php';
require_once './modele/authentification.php';
require_once './vue/elements/head.php';
require_once './controleur/controleurPrincipal.php';

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['page'])) {

    // Nom page
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

} else {

    $page = "accueil";

}

$controleur = controleur($page);
require_once './controleur/'.$controleur;

require_once './vue/elements/footer.php';