<?php

class Appartement_DAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

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

    public function getAppartements(int $numPremierePage, int $nbParPage) {

        $resultat = false;

        $bdd = $this->getPDO();
        $sql = "Select a.ID, a.TITRE, t.LIBETYPE, i.VILLE from appartement a 
                join typeappart t on a.ID_TYPEAPPART = t.ID 
                join immeuble i on a.ID_IMMEUBLE = i.ID LIMIT :premier, :parpage";
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

    public function getAppartementById(int $idAppartement) {

        $resultat = false;

        $bdd = $this->getPDO();
        $sql = "Select a.ID, a.TITRE, a.DESCRIPTION, t.LIBETYPE, t.TARIFLOCABASE, i.ADRESSE, i.VILLE, i.ASCENSSEUR from appartement a 
                join typeappart t on a.ID_TYPEAPPART = t.ID 
                join immeuble i on a.ID_IMMEUBLE = i.ID
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
}