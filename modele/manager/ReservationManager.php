<?php

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
     * Insertion d'une réservation
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

    /** Récupération d'une réservation
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
     * Récupération des réservations d'un utilisateur
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

}