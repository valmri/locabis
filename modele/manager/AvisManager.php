<?php

namespace modele\manager;

use modele\entite\Avis;

class AvisManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Création d'un avis
     * @param Avis $avis
     * @return bool
     */
    public function create(Avis $avis) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into avis(id_reservation, id_appartement, note, commentaire, date_publication) values (:idreservation, :idappart, :note, :commentaire, :date);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idreservation', $avis->getReservation(), PDO::PARAM_INT);
            $requete->bindValue(':idappart', $avis->getAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $requete->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);
            $requete->bindValue(':date', $avis->getDatePublication(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un avis
     * @param int $idReservation
     * @param int $idAppart
     * @return false|mixed|object|\stdClass|null
     */
    public function read(int $idReservation, int $idAppart) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from avis where id_reservation = :idr and id_appartement = :ida;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idr', $idReservation, PDO::PARAM_INT);
            $requete->bindValue(':ida', $idAppart, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\TypeEtat');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les avis d'un appart
     * @param int $idAppartement
     * @return array|false
     */
    public function readAll(int $idAppartement) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from avis where id_appartement = :idappart;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idappart', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Avis');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un avis
     * @param Avis $avis
     * @return bool
     */
    public function update(Avis $avis) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update avis set note = :note, commentaire = :com, date_publication = now() where id_appartement = :ida and id_reservation = :idr;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $requete->bindValue(':com', $avis->getCommentaire(), PDO::PARAM_STR);
            $requete->bindValue(':ida', $avis->getAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':idr', $avis->getReservation(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un avis
     * @param Avis $avis
     * @return bool
     */
    public function delete(Avis $avis) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from avis where id_reservation = :idr and id_appartement = :ida limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $avis->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}