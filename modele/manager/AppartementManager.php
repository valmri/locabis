<?php

namespace modele\manager;

use PDO;
use modele\entite\Appartement;

class AppartementManager extends ManagerPrincipal
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insertion d'un appartement
     * @param Appartement $appartement
     * @return bool
     */
    public function create(Appartement $appartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Insert into appartement(type, immeuble, proprietaire, titre, description, numero, etage, photo) 
                    values (:type, :immeuble, :proprio, :titre, :desc, :num, :etage, :photo);";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':type', $appartement->getType(), PDO::PARAM_STR);
            $requete->bindValue(':immeuble', $appartement->getImmeuble(), PDO::PARAM_INT);
            $requete->bindValue(':proprio', $appartement->getProprietaire(), PDO::PARAM_INT);
            $requete->bindValue(':titre', $appartement->getTitre(), PDO::PARAM_STR);
            $requete->bindValue(':desc', $appartement->getDescription(), PDO::PARAM_STR);
            $requete->bindValue(':num', $appartement->getNumero(), PDO::PARAM_INT);
            $requete->bindValue(':etage', $appartement->getEtage(), PDO::PARAM_INT);
            $requete->bindValue(':photo', $appartement->getPhoto(), PDO::PARAM_STR);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération d'un appartement
     * @param int $idAppartement
     * @return bool|Appartement
     */
    public function read(int $idAppartement) {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from appartement where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $idAppartement, PDO::PARAM_INT);
            $requete->execute();
            $resultat =$requete->fetchObject('modele\entite\Appartement');
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Récupération de tous les appartements
     * @param int $idAppartement
     * @return bool|Appartement
     */
    public function readAll() {

        try {
            $bdd = $this->getPDO();
            $sql = "Select * from appartement;";
            $requete = $bdd->prepare($sql);
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_CLASS, 'modele\entite\Appartement');
            $resultat =$requete->fetchAll();
        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Mise à jour d'un appartement
     * @param Appartement $appartement
     * @return bool
     */
    public function update(Appartement $appartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Update appartement 
                    set type = :type, immeuble = :immeuble, proprietaire = :proprio, titre = :titre, description = :desc, numero = :num, etage = :etage, photo = :photo
                    where id = :id;";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':type', $appartement->getType(), PDO::PARAM_STR);
            $requete->bindValue(':immeuble', $appartement->getImmeuble(), PDO::PARAM_INT);
            $requete->bindValue(':proprio', $appartement->getProprietaire(), PDO::PARAM_INT);
            $requete->bindValue(':titre', $appartement->getTitre(), PDO::PARAM_STR);
            $requete->bindValue(':desc', $appartement->getDescription(), PDO::PARAM_STR);
            $requete->bindValue(':num', $appartement->getNumero(), PDO::PARAM_INT);
            $requete->bindValue(':etage', $appartement->getEtage(), PDO::PARAM_INT);
            $requete->bindValue(':photo', $appartement->getPhoto(), PDO::PARAM_STR);
            $requete->bindValue(':id', $appartement->getId(), PDO::PARAM_INT);

            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Suppression d'un appartement
     * @param Appartement $appartement
     * @return bool
     */
    public function delete(Appartement $appartement) {

        try {

            $bdd = $this->getPDO();
            $sql = "Delete from appartement where id = :id";
            $requete = $bdd->prepare($sql);
            $requete->bindValue(':id', $appartement->getId(), PDO::PARAM_INT);
            $requete->execute();

            $resultat = true;

        } catch (Exception $e) {
            $resultat = false;
        }

        return $resultat;

    }

    /**
     * Retourne le nombre total d'appartement présent en base de données
     * @return false|int
     */
    public function getNbAppartements() {

        $resultat = false;

        $bdd = $this->getPDO();
        $sql = "Select count(*) as nbAppart from appartement";
        $requete = $bdd->prepare($sql);
        $requete->execute();
        $reponse = $requete->fetch();

        if(count($reponse) > 0) {
            $resultat = (int)$reponse['nbAppart'];
        }

        return $resultat;

    }

    /**
     * Récupération des appartements pour la page d'accueil
     * @param int $numPremierePage
     * @param int $nbParPage
     * @return array|false
     */
    public function getAppartements(int $numPremierePage, int $nbParPage) {

        $resultat = false;

        $bdd = $this->getPDO();
        $sql = "select a.id, a.titre, a.photo, t.libetype, i.ville from appartement a 
                join typeappart t on a.type = t.id 
                join immeuble i on a.immeuble = i.id 
                limit :premier, :parpage;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':premier', $numPremierePage, PDO::PARAM_INT);
        $requete->bindValue(':parpage', $nbParPage, PDO::PARAM_INT);
        $requete->execute();
        $reponse = $requete->fetchAll(PDO::FETCH_OBJ);

        if(count($reponse) > 0) {
            $resultat = $reponse;
        }

        return $resultat;

    }

    /**
     * Méthodes ancestrales
     *
    public function getAppartementById(int $idAppartement) {

    $resultat = false;

    $bdd = $this->getPDO();
    $sql = "Select * from appartement a
    where a.ID = :id";
    $requete = $bdd->prepare($sql);
    $requete->bindValue(':id', $idAppartement, PDO::PARAM_INT);
    $requete->execute();
    $reponse = $requete->fetch(PDO::FETCH_OBJ);


    if(!empty($reponse)) {
    $resultat = $reponse;
    }

    return $resultat;

    }

    public function getTypeAppart(int $idAppartement) {

    $resultat = false;

    $bdd = $this->getPDO();
    $sql = "Select t.ID, t.LIBETYPE, t.TARIFLOCABASE from appartement a
    join typeappart t on a.ID_TYPEAPPART = t.ID
    where a.ID = :id";
    $requete = $bdd->prepare($sql);
    $requete->bindValue(':id', $idAppartement, PDO::PARAM_INT);
    $requete->execute();
    $reponse = $requete->fetch(PDO::FETCH_OBJ);


    if(!empty($reponse)) {
    $resultat = $reponse;
    }

    return $resultat;

    }
     */



}