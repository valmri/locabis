<?php
/**
 * EquipementManager.php
 * Description : Manager permettant de manipuler les données de la table Equipement
 * @author : Valentin Marmié
 */
namespace modele\manager;

use Ds\Vector;
use modele\entite\Appartement;
use modele\entite\Equipement;
use PDO;

class EquipementManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Enregistrement d'un équipement
     * @param Equipement $equipement
     * @return bool
     */
    public function create(Equipement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into equipement(icone, libelle) values (:icone, :libelle);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':icone', $equipement->getIcone(), PDO::PARAM_STR);
            $requete->bindValue(':libelle', $equipement->getLibelle(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un enregistrement concernant un équipement
     * @param string $idEquipement
     * @return bool|Equipement
     */
    public function read(string $idEquipement) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from equipement where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idEquipement, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Equipement');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les enregistrements concernant les équipements
     * @return bool|array
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from equipement;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Equipement');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un enregistrement concernant un équipement
     * @param Equipement $equipement
     * @return bool
     */
    public function update(Equipement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update equipement set icone = :icone, libelle = :libelle where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':icone', $equipement->getIcone(), PDO::PARAM_STR);
            $requete->bindValue(':libelle', $equipement->getLibelle(), PDO::PARAM_STR);
            $requete->bindValue(':id', $equipement->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un enregistrement concernant un équipement
     * @param Equipement $equipement
     * @return bool
     */
    public function delete(Equipement $equipement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from equipement where id = :id limit 1;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $equipement->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}