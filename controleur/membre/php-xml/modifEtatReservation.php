<?php
/**
 * modifEtatReservation.php
 * Description : Permet de changer l'état d'une réservation avec la méthode AJAX depuis l'espace proriétaire
 * @author : Valentin Marmié
 */
// Initialisation de l'entête de la requête
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/xml; charset=UTF-8');

// Chargement des managers
require_once '../../../modele/manager/ManagerPrincipal.php';
require_once '../../../modele/manager/ReservationManager.php';
require_once '../../../modele/manager/TypeEtatManager.php';
require_once '../../../modele/entite/Reservation.php';
require_once '../../../modele/entite/TypeEtat.php';

use modele\manager\ReservationManager;
use modele\manager\TypeEtatManager;

$reservationManager = new ReservationManager();
$typeEtatManager = new TypeEtatManager();

// Récupération de l'identifiant de la réservation
if(
    isset($_POST['idEtat']) && !empty($_POST['idEtat']) && is_numeric($_POST['idEtat']) &&
    isset($_POST['idReservation']) && !empty($_POST['idReservation']) && is_numeric($_POST['idReservation'])
) {
    $idEtat = filter_input(INPUT_POST, 'idEtat', FILTER_SANITIZE_NUMBER_INT);
    $idReservation = filter_input(INPUT_POST, 'idReservation', FILTER_SANITIZE_NUMBER_INT);

    // Récupération de la réservation
    $reservation = $reservationManager->read($idReservation);

    if($reservation) {

        // Mise à jour de l'état
        $reservation->setEtat($idEtat);
        $majSucces = $reservationManager->update($reservation);

        // Récupération du nouvel état à afficher
        if($majSucces) {

            // Récupération de l'etat
            $etatReservation = $typeEtatManager->read($reservation->getEtat());

        }

    } else {
        $majSucces = false;
    }
} else {
    $majSucces = false;
}

// Génération du fichier XML
echo '<?xml version="1.0" encoding="UTF-8"?>';

echo '<enregistrement>';

if($majSucces) {
    echo '<reponse>true</reponse>';
    echo '<etat>';
    echo '<reservation>' . $reservation->getId() . '</reservation>';
    echo '<libelle>' . $etatReservation->getLibelle() . '</libelle>';
    echo '</etat>';
} else {
    echo '<reponse>false</reponse>';
}

echo '</enregistrement>';