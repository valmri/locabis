<?php
/**
 * TypeEtatManager.php
 * Description : Manager permettant de manipuler les données de la table TypeEtat
 * @author : Valentin Marmié
 */
namespace modele\manager;

use modele\entite\TypeEtat;
use PDO;

class TypeEtatManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Création d'un état
     * @param TypeEtat $etat
     * @return bool
     */
    public function create(TypeEtat $etat) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into typeetat(icone, libelle) VALUES (:icone, :libelle);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':type', $etat->getIcone(), PDO::PARAM_STR);
            $requete->bindValue(':type', $etat->getLibelle(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un état
     * @param int $idEtat
     * @return false|mixed|object|\stdClass|null
     */
    public function read(int $idEtat) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from typeetat where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idEtat, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\TypeEtat');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les états
     * @return array|false
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from typeetat;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\TypeEtat');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un état
     * @param TypeEtat $etat
     * @return bool
     */
    public function update(TypeEtat $etat) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update typeetat set icone = :icone, libelle = :libelle where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':icone', $etat->getIcone(), PDO::PARAM_STR);
            $requete->bindValue(':libelle', $etat->getLibelle(), PDO::PARAM_STR);
            $requete->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un état
     * @param TypeEtat $etat
     * @return bool
     */
    public function delete(TypeEtat $etat) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from typeetat where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $etat->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    public function getEtatsProp() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from typeetat where id > 1 and id < 4;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\TypeEtat');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    public function getLibelle(int $id) {
        try {
            $bdd = $this->getPDO();
            $sql = "Select libelle from typeetat where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetch();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;
    }
}