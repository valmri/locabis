<?php

namespace modele\manager;

use PDO;
use modele\entite\Immeuble;

class ImmeubleManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Enregistrement d'un immeuble dans la base de données
     * @param Immeuble $immeuble
     * @return bool
     */
    public function create(Immeuble $immeuble) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into immeuble(adresse, ville, nbetage, ascensseur) VALUES (:adresse, :ville, :etage, :ascensseur);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':adresse', $immeuble->getAdresse(), PDO::PARAM_STR);
            $requete->bindValue(':ville', $immeuble->getVille(), PDO::PARAM_STR);
            $requete->bindValue(':etage', $immeuble->getNbetage(), PDO::PARAM_INT);
            $requete->bindValue(':ascensseur', $immeuble->isAscenseur(), PDO::PARAM_BOOL);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un enregistrement concernant un immeuble
     * @param int $idImmeuble
     * @return bool|Immeuble
     */
    public function read(int $idImmeuble) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from immeuble where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idImmeuble, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Immeuble');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les enregistrements concernant les immeubles
     * @return bool|array
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from immeuble;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Immeuble');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un enregistrement concernant un immeuble
     * @param Immeuble $immeuble
     * @return bool
     */
    public function update(Immeuble $immeuble) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update immeuble set adresse = :adresse, ville = :ville, nbetage = :nbetage, ascensseur = :ascensseur where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':adresse', $immeuble->getAdresse(), PDO::PARAM_STR);
            $requete->bindValue(':ville', $immeuble->getVille(), PDO::PARAM_STR);
            $requete->bindValue(':nbetage', $immeuble->getNbetage(), PDO::PARAM_INT);
            $requete->bindValue(':ascensseur', $immeuble->isAscenseur(), PDO::PARAM_BOOL);
            $requete->bindValue(':id', $immeuble->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un enregistrement concernant un immeuble
     * @param Immeuble $immeuble
     * @return bool
     */
    public function delete(Immeuble $immeuble) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from immeuble where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $immeuble->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

}