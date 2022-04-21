<?php

class Utilisateur_DAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUtilisateur(int $idUtilisateur) {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select * from utilisateur where ID = :id;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if(!empty($utilisateur)) {

            $resultat = new Utilisateur(
                $utilisateur['ID'],
                'null',
                $utilisateur['NOM'],
                $utilisateur['PRENOM'],
                $utilisateur['MEL'],
                $utilisateur['MOTDEPASSE'],
                $utilisateur['DATE_CONNEXION'],
                $utilisateur['DATE_INSCRIPTION']);

        }

        return $resultat;

    }

}