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
     * Enregistrement d'un avis
     * @param Avis $avis
     * @return bool
     */
    public function create(Avis $avis) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into avis(reservation, note, commentaire, date_publication) values (:idreservation,:note, :commentaire, now());";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idreservation', $avis->getReservation(), PDO::PARAM_INT);
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
     * Récupération d'un enregistrement concernant un avis
     * @param int $idReservation
     * @param int $idAppart
     * @return bool|Avis
     */
    public function read(int $idReservation) {

        try {
            $bdd = $this->getPDO();
            $sql = "select * from avis where reservation = :idr;";
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
     * Récupère tous enregistrements concernant les avis
     * @return bool|array
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
     * Mise à jour d'un enregistrement concernant un avis
     * @param Avis $avis
     * @return bool
     */
    public function update(Avis $avis) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update avis set note = :note, commentaire = :com, date_publication = now() where reservation = :idr;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $requete->bindValue(':com', $avis->getCommentaire(), PDO::PARAM_STR);
            $requete->bindValue(':idr', $avis->getReservation(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un enregistrement concernant un avis
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
            $sql = "select r.id as id_reservation, u.id as id_utilisateur, u.prenom, av.note, av.commentaire, av.date_publication from reservation r
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

                foreach ($tableauAvis as $avis) {

                    $unAvis = new Vector();
                    $unAvis->push($avis['id_reservation']);
                    $unAvis->push($avis['id_utilisateur']);
                    $unAvis->push($avis['prenom']);
                    $unAvis->push(date('d/m/Y', strtotime($avis['date_publication'])));
                    $unAvis->push($avis['note']);
                    $unAvis->push($avis['commentaire']);

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
     * @return bool
     */
    public function verifAvis(int $idUtilisateur, int $idAppart) {

        $resultat = true;

        try {
            $bdd = $this->getPDO();
            $sql = "select count(*) as nbReservation from reservation r
                    join utilisateur u on u.id = r.utilisateur
                    join appartement a on a.id = r.appartement
                    where r.utilisateur = :idu and r.appartement = :ida;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idu', $idUtilisateur, PDO::PARAM_INT);
            $requete->bindValue(':ida', $idAppart, PDO::PARAM_INT);
            $requete->execute();
            $reponse =$requete->fetch();

            // S'il existe une ou plusieurs réservations l'utilisateur ne pourra pas publier de nouvel avis sur l'appart
            if($reponse > 0) {
                $resultat = false;
            }

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;
    }

    /**
     * Vérification de la propriété de l'avis
     * @param int $idAppartement
     * @param int $idProp
     * @return bool
     */
    public function verifPropAvis(int $idAppartement, int $idProp) {

        $resultat = true;

        try {
            $bdd = $this->getPDO();
            $sql = "select count(*) as existe from reservation r
                    join avis a on a.reservation = r.id
                    where r.appartement = :ida and r.utilisateur = :idp;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':ida', $idAppartement, PDO::PARAM_INT);
            $requete->bindValue(':idp', $idProp, PDO::PARAM_INT);
            $requete->execute();
            $reponse =$requete->fetch();

            if((int)$reponse['existe'] <= 0) {
                $resultat = false;
            }

        } catch (Exception $e) {
            $resultat = $e;
        }

        return $resultat;

    }

}