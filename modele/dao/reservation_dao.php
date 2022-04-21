<?php

class Reservation_DAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addReservation(int $idUtilisateur, int $idAppartement, string $dateDebut, string $dateFin) {

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Insert into reservation(ID_UTILISATEUR, ID_APPARTEMENT, DATE_DEBUT, DATE_FIN, DUREE) values(:idUtilisateur, :idAppart, :dateDebut, :dateFin, DATEDIFF(:dateDebut, :dateFin)) ";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $requete->bindValue(':idAppart', $idAppartement, PDO::PARAM_INT);
        $requete->bindValue(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $requete->bindValue(':dateFin', $dateFin, PDO::PARAM_STR);
        $requete->execute();

    }

    public function getReservationByUserId(int $idUtilisateur) {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select * from reservation r 
                join appartement a on r.ID_APPARTEMENT = a.ID    
                where ID_UTILISATEUR = :id";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
        $requete->execute();
        $reponse = $requete->fetchAll(PDO::FETCH_OBJ);

        if(count($reponse) > 0) {
            $resultat = $reponse;
        }

        return $resultat;

    }

}