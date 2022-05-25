<?php
/**
 * archiverReservation.php
 * Description : Permet d'archiver une réservation par la méthode AJAX
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
if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {
    $idReservation = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Récupération de la réservation
    $reservation = $reservationManager->read($idReservation);

    if($reservation) {
        /**
         * Rappel des identifiant d'état :
         * - 1 = "En attente de confirmation"
         * - 2 = "Refusé"
         * - 3 = "Validé"
         * - 4 = "Annulé"
         * - 5 = "Archivé"
         */

        // Mise à jour de l'état
        $reservation->setEtat(5);
        $majSucces = $reservationManager->update($reservation);

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
    echo '<icone>' . $etatReservation->getIcone() . '</icone>';
    echo '<libelle>' . $etatReservation->getLibelle() . '</libelle>';
    echo '</etat>';
} else {
    echo '<reponse>false</reponse>';
}

echo '</enregistrement>';