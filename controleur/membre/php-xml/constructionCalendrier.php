<?php
// Initialisation de l'entête de la requête
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/xml; charset=UTF-8');

// Chargement des managers
require_once '../../../modele/manager/ManagerPrincipal.php';
require_once '../../../modele/manager/ReservationManager.php';
require_once '../../../modele/entite/Reservation.php';

use modele\manager\ReservationManager;

$reservationManager = new ReservationManager();

// Récupération de l'identifiant de l'appart
if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {

    // Nettoyage de l'identifiant
    $idAppartement = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération des dates
    $lesDates = $reservationManager->getDatesReservees($idAppartement);
}

// Génération du fichier XML
echo '<?xml version="1.0" encoding="UTF-8"?>';

echo '<enregistrement>';

foreach ($lesDates as $date) {
    echo '<date>';
    echo '<dateDebut>'. $date['date_debut'] .'</dateDebut>';
    echo '<dateFin>'. $date['date_fin'] .'</dateFin>';
    echo '</date>';
}

echo '</enregistrement>';