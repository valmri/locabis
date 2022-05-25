<?php
/**
 * ReservationManager.php
 * Description : Manager permettant de manipuler les données de la table Reservation
 * @author : Valentin Marmié
 */
namespace modele\manager;

use PDO;
use modele\entite\Reservation;

class ReservationManager extends ManagerPrincipal
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Enregistrement d'une réservation
     * @param Reservation $reservation
     * @return bool
     */
    public function create(Reservation $reservation) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into reservation(utilisateur, appartement, date_debut, date_fin, duree) values (:utilisateur, :appartement, :date_d, :date_f, datediff(:date_f, :date_d))";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':utilisateur', $reservation->getUtilisateur(), PDO::PARAM_STR);
            $requete->bindValue(':appartement', $reservation->getAppartement(), PDO::PARAM_STR);
            $requete->bindValue(':date_d', $reservation->getDateDebut(), PDO::PARAM_STR);
            $requete->bindValue(':date_f', $reservation->getDateFin(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un enregistrement concernant une réservation
     * @param int $idReservation
     * @return bool|Reservation
     */
    public function read(int $idReservation) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from reservation where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idReservation, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Reservation');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération des enregistrements des réservations effectuées par un utilisateur
     * @param int $idUtilisateur
     * @return array|false
     */
    public function readAll(int $idUtilisateur) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from reservation where utilisateur = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Reservation');
            $resultat = $requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'une réservation
     * @param Reservation $reservation
     * @return bool
     */
    public function update(Reservation $reservation) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update reservation set date_debut = :date_d, date_fin = :date_f, duree = datediff(:date_f, :date_d), etat = :etat where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':date_d', $reservation->getDateDebut(), PDO::PARAM_STR);
            $requete->bindValue(':date_f', $reservation->getDateFin(), PDO::PARAM_STR);
            $requete->bindValue(':etat', $reservation->getEtat(), PDO::PARAM_INT);
            $requete->bindValue(':id', $reservation->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'une réservation
     * @param Reservation $reservation
     * @return bool
     */
    public function delete(Reservation $reservation) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from reservation where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $reservation->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour de l'état d'une réservation
     * @param Reservation $reservation
     * @return bool
     */
    public function updateEtat(Reservation $reservation) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update reservation set etat = :etat where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':etat', $reservation->getEtat(), PDO::PARAM_INT);
            $requete->bindValue(':id', $reservation->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Retourne les dates de réservation d'un appartement
     * @param int $idAppartement
     * @return bool|array
     */
    public function getDatesReservees(int $idAppartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Select date_debut, date_fin from reservation where appartement = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'une réservation pour vérifier un avis
     * @param int $idUtilisateur
     * @param int $idAppartement
     * @return false|mixed
     */
    public function getReservationForAvis(int $idUtilisateur, int $idAppartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Select * from reservation where utilisateur = :idu and appartement = :ida order by id desc limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idu', $idUtilisateur, PDO::PARAM_INT);
            $requete->bindValue(':ida', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Reservation');
            $resultat = $requete->fetch();

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    public function getReservationByIdAppart(int $idAppart) {

        try {

            $bdd = $this->getPDO();
            $sql = "select * from reservation r where appartement = :id and etat != 5 order by id desc;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idAppart, PDO::PARAM_INT);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Reservation');
            $resultat = $requete->fetchAll();

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}