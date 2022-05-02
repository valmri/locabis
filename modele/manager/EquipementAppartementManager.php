<?php

namespace modele\manager;

use modele\entite\EquipementAppartement;
use PDO;

class EquipementAppartementManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Création d'un équipement pour un appartement
     * @param EquipementAppartement $equipement
     * @return bool
     */
    public function create(EquipementAppartement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into equipement_appart(id_appartement, id_equipement, quantite) VALUES (:idAppart, :idEquipement, :quantite);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idAppart', $equipement->getIdAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':idEquipement', $equipement->getIdEquipement(), PDO::PARAM_INT);
            $requete->bindValue(':quantite', $equipement->getQuantite(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération des équipements d'un appartement
     * @param EquipementAppartement $equipement
     * @return false|mixed|object|\stdClass|null
     */
    public function read(EquipementAppartement $equipement) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from equipement_appart where id_appartement = :ida and id_equipement = :ide;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':ida', $equipement->getIdAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':ide', $equipement->getIdEquipement(), PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\EquipementAppartement');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un équipement d'un appartement
     * @param EquipementAppartement $equipement
     * @return bool
     */
    public function update(EquipementAppartement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update equipement_appart set quantite = :quantite where id_appartement = :ida and id_equipement = :ide limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':quantite', $equipement->getQuantite(), PDO::PARAM_INT);
            $requete->bindValue(':ida', $equipement->getIdAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':ide', $equipement->getIdEquipement(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un équipement d'un appartement
     * @param EquipementAppartement $equipement
     * @return bool
     */
    public function delete(EquipementAppartement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from equipement_appart where id_appartement = :ida and id_equipement = :ide limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':ida', $equipement->getIdAppartement(), PDO::PARAM_INT);
            $requete->bindValue(':ide', $equipement->getIdEquipement(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Vérifier si un équipement existe dans un appartement
     * @param int $idAppart
     * @param int $idEquipement
     * @return bool
     */
    public function existe(int $idAppart, int $idEquipement) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select count(*) as existe from equipement_appart where id_appartement = :ida and id_equipement = :ide;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':ida', $idAppart, PDO::PARAM_INT);
            $requete->bindValue(':ide', $idEquipement, PDO::PARAM_INT);
            $requete->execute();
            $reponse = $requete->fetch();

            if((int)$reponse['existe'] != 0) {
                $resultat = true;
            } else {
                $resultat = false;
            }

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}