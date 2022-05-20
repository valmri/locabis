<?php

namespace modele\manager;

use Ds\Vector;
use modele\entite\Avis;
use modele\entite\Utilisateur;
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
            $sql = "Insert into avis(reservation, appartement, utilisateur, note, commentaire, date_publication) values (:idreservation, :idappart, :idutil, :note, :commentaire, now());";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idreservation', $avis->getReservation(), PDO::PARAM_INT);
            $requete->bindValue(':idappart', $avis->getAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':idutil', $avis->getUtilisateur(), PDO::PARAM_INT);
            $requete->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $requete->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);
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
    public function read(int $idReservation) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from avis where reservation = :idr;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idr', $idReservation, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Avis');
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
            $sql = "Update avis set note = :note, commentaire = :com, date_publication = now() where appartement = :ida and reservation = :idr;";
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
            $sql = "Delete from avis where reservation = :idr and appartement = :ida limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $avis->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération des avis d'un appartement
     * @param int $idAppartement
     * @return Vector|false
     */
    public function getAvisByIdAppart(int $idAppartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "select r.id as id_reservation, av.note, av.commentaire, av.date_publication, u.id as id_utilisateur, u.prenom from reservation r
                    join avis av on r.id  = av.reservation  
                    join utilisateur u on r.utilisateur =  u.id 
                    where r.appartement = :idappart
                    order by av.date_publication desc";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idappart', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $tableauAvis = $requete->fetchAll(PDO::FETCH_ASSOC);

            if(count($tableauAvis) > 0) {
                $collectionAvis = new Vector();

                $utilisateurManager = new UtilisateurManager();

                foreach ($tableauAvis as $avis) {

                    $unAvis = new Avis();
                    $unAvis->setReservation($avis['id_reservation']);

                    $utilisateur = $utilisateurManager->read($avis['id_utilisateur']);

                    $lutilisateur = new Utilisateur();
                    $lutilisateur->setId($utilisateur->getId());
                    $lutilisateur->setPrenom($utilisateur->getPrenom());
                    $unAvis->setUtilisateur($lutilisateur);

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

    /**
     * Permet de vérifier l'existence d'un avis
     * @param int $idUtilisateur
     * @param int $idAppart
     * @return false|mixed|object|\stdClass|null
     */
    public function avisExistant(int $idUtilisateur, int $idAppart) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from avis where utilisateur = :idu and appartement = :ida;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idu', $idUtilisateur, PDO::PARAM_INT);
            $requete->bindValue(':ida', $idAppart, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Avis');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;
    }

}