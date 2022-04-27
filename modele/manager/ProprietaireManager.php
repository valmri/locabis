<?php

namespace modele\manager;

use modele\entite\Proprietaire;
use PDO;

class ProprietaireManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Création d'un propriétaire
     * @param Proprietaire $proprietaire
     * @return bool
     */
    public function create(Proprietaire $proprietaire) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into proprietaire(id, adresse, ville, telephone) values (:idUtilisateur, :adresse, :ville, :telephone)";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':idUtilisateur', $proprietaire->getId(), PDO::PARAM_INT);
            $requete->bindValue(':adresse', $proprietaire->getAdresse(), PDO::PARAM_STR);
            $requete->bindValue(':ville', $proprietaire->getVille(), PDO::PARAM_STR);
            $requete->bindValue(':telephone', $proprietaire->getTelephone(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un propriétaire
     * @param int $idProprietaire
     * @return bool|mixed|\modele\entite\Proprietaire|object|\stdClass|null
     */
    public function read(int $idProprietaire) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from proprietaire p where p.id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idProprietaire, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Proprietaire');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un propriétaire
     * @param Proprietaire $proprietaire
     * @return bool
     */
    public function update(Proprietaire $proprietaire) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update proprietaire set adresse = :adresse, ville = :ville, telephone = :tel where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':adresse', $proprietaire->getAdresse(), PDO::PARAM_STR);
            $requete->bindValue(':ville', $proprietaire->getVille(), PDO::PARAM_STR);
            $requete->bindValue(':tel', $proprietaire->getTelephone(), PDO::PARAM_STR);
            $requete->bindValue(':id', $proprietaire->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un proprietaire
     * @param Proprietaire $proprietaire
     * @return bool
     */
    public function delete(Proprietaire $proprietaire) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from proprietaire where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $proprietaire->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }
}