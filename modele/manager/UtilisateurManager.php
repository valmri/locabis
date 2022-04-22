<?php

namespace modele\manager;

use PDO;
use modele\entite\Utilisateur;

class UtilisateurManager extends ManagerPrincipal
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insertion d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function create(Utilisateur $utilisateur) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into utilisateur(nom, prenom, mel, motdepasse, date_inscription) values (:nom, :prenom, :mel, :mdp, :date_inscription)";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $requete->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $requete->bindValue(':mel', $utilisateur->getMel(), PDO::PARAM_STR);
            $requete->bindValue(':mdp', $utilisateur->getMotDePasse(), PDO::PARAM_STR);
            $requete->bindValue(':date_inscription', $utilisateur->getDateInscription(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un utilisateur
     * @param int $idUtilisateur
     * @return bool|Utilisateur
     */
    public function read(int $idUtilisateur) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from utilisateur where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Utilisateur');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function update(Utilisateur $utilisateur) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update utilisateur set nom = :nom, prenom = :prenom, mel = :mel, motDePasse = :mdp where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $requete->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $requete->bindValue(':mel', $utilisateur->getMel(), PDO::PARAM_STR);
            $requete->bindValue(':mdp', $utilisateur->getMotDePasse(), PDO::PARAM_STR);
            $requete->bindValue(':id', $utilisateur->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un utilisateur
     * @param Utilisateur $utilisateur
     * @return bool
     */
    public function delete(Utilisateur $utilisateur) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from utilisateur where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $utilisateur->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Connexion de l'utilisateur à l'application
     * @param Utilisateur $utilisateur
     * @return array|false
     */
    public function connexion(Utilisateur $utilisateur) {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select id, mel, motDePasse from utilisateur where mel = :mel;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':mel', $utilisateur->getMel(), PDO::PARAM_STR);
        $requete->execute();
        $infos = $requete->fetch(PDO::FETCH_ASSOC);

        if(!empty($infos)) {

            // Infos de la bdd
            $id = $infos['id'];
            $mel = $infos['mel'];
            $mdp = $infos['motDePasse'];

            if ($utilisateur->getMel() ===  $mel && password_verify($utilisateur->getMotDePasse(), $mdp)) {

                // Données renvoyées
                $resultat =  array(
                    'ID' => $id,
                    'MEL' => $mel,
                    'MOTDEPASSE' => $utilisateur->getMotDePasse()
                );

                // Mise à jour date connexion
                $bdd = $this->getPDO();
                $sql = "Update utilisateur set date_connexion = :date where ID = :id";
                $requete = $bdd->prepare($sql);
                $requete->bindValue(':date', date('Y-m-d H:m:s'), PDO::PARAM_STR);
                $requete->bindValue(':id', $id, PDO::PARAM_INT);
                $requete->execute();

            }

        }

        return $resultat;

    }

}