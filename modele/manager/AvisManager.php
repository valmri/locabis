<?php

namespace modele\manager;

use Ds\Vector;
use modele\entite\Avis;
use PDO;

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
     * Récupère tous les avis
     * @return array|false
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from avis;";
            $requete = $bdd->prepare($sql);
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

    public function getAvisByIdAppart(int $idAppartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Select a.note, a.commentaire, a.date_publication, u.prenom from avis a
                    join reservation r on a.id_reservation = r.id
                    join utilisateur u on r.utilisateur = u.id
                    where id_appartement = :idappart 
                    order by a.date_publication desc";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idappart', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $tableauAvis = $requete->fetchAll(PDO::FETCH_ASSOC);

            if(count($tableauAvis) > 0) {
                $collectionAvis = new Vector();

                foreach ($tableauAvis as $avis) {

                    $unAvis = new Avis();
                    $unAvis->setUtilisateur($avis['prenom']);
                    $unAvis->setDatePublication(date('d/m/Y', strtotime($avis['date_publication'])));
                    $unAvis->setNote($avis['note']);
                    $unAvis->setCommentaire($avis['commentaire']);
                    $collectionAvis->push($unAvis);

                }

                $resultat = $collectionAvis;

            } else {
                $resultat = false;
            }


        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}