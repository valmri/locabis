<?php
/**
 * TypeAppartManager.php
 * Description : Manager permettant de manipuler les données de la table TypeAppart
 * @author : Valentin Marmié
 */
namespace modele\manager;

use modele\entite\TypeAppart;
use PDO;

class TypeAppartManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Enregistrement d'un type d'appart
     * @param TypeAppart $typeAppart
     * @return bool
     */
    public function create(TypeAppart $typeAppart) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into typeappart(libetype, tariflocabase) VALUES (:libelle, :tarif);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':libelle', $typeAppart->getLibetype(), PDO::PARAM_STR);
            $requete->bindValue(':tarif', $typeAppart->getTariflocabase(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un enregistrement concernant un type d'appart
     * @param int $idType
     * @return false|TypeAppart
     */
    public function read(string $idType) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from typeappart where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idType, PDO::PARAM_STR);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\TypeAppart');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les types d'appart
     * @return array|false
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from typeappart;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\TypeAppart');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un type d'appart
     * @param TypeAppart $typeAppart
     * @return bool
     */
    public function update(TypeAppart $typeAppart) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update typeappart set libetype = :libelle, tariflocabase = :tarif where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':libelle', $typeAppart->getLibetype(), PDO::PARAM_STR);
            $requete->bindValue(':tarif', $typeAppart->getTariflocabase(), PDO::PARAM_STR);
            $requete->bindValue(':id', $typeAppart->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un type appart
     * @param TypeAppart $typeAppart
     * @return bool
     */
    public function delete(TypeAppart $typeAppart) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from typeappart where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $typeAppart->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}