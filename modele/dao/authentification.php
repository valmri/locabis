<?php

class Authentification extends DAO
{
    private $identifiant;
    private $motDePasse;

    public function __construct(string $identifiant, string $motDePasse)
    {
        parent::__construct();
        $this->identifiant = $identifiant;
        $this->motDePasse = $motDePasse;
    }

    public function connexion() {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select ID, MEL, MOTDEPASSE from utilisateur where MEL = :identifiant;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':identifiant', $this->identifiant, PDO::PARAM_STR);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if(!empty($utilisateur)) {

            $identifiantUtilisateur = $utilisateur['MEL'];
            $mdpUtilisateur = $utilisateur['MOTDEPASSE'];

            if ($this->identifiant ===  $identifiantUtilisateur && password_verify($this->motDePasse, $mdpUtilisateur)) {

                // Données renvoyées
                $resultat =  array(
                    'ID' => $utilisateur['ID'],
                    'MEL' => $utilisateur['MEL'],
                    'MOTDEPASSE' => $this->motDePasse
                );

                // Mise à jour date connexion
                $bdd = $this->getPDO();
                $sql = "Update utilisateur set DATE_CONNEXION = :date where ID = :id";
                $requete = $bdd->prepare($sql);
                $requete->bindValue(':date', date('Y-m-d H:m:s'), PDO::PARAM_STR);
                $requete->bindValue(':id', $utilisateur['ID'], PDO::PARAM_INT);
                $requete->execute();

            }

        }

        return $resultat;

    }

    public function estConnecte() {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select * from utilisateur where MEL = :identifiant;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':identifiant', $this->identifiant, PDO::PARAM_STR);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if(!empty($utilisateur)) {

            $identifiantUtilisateur = $utilisateur['MEL'];
            $mdpUtilisateur = $utilisateur['MOTDEPASSE'];

            if ($this->identifiant ===  $identifiantUtilisateur && password_verify($this->motDePasse, $mdpUtilisateur)) {

                $resultat = true;

            }
        }

        return $resultat;

    }

    public function getUtilisateur() {

        $resultat = false;

        // Requête SQL
        $bdd = $this->getPDO();
        $sql = "Select * from utilisateur where MEL = :identifiant;";
        $requete = $bdd->prepare($sql);
        $requete->bindValue(':identifiant', $this->identifiant, PDO::PARAM_STR);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if(!empty($utilisateur)) {

            $identifiantUtilisateur = $utilisateur['MEL'];
            $mdpUtilisateur = $utilisateur['MOTDEPASSE'];

            if ($this->identifiant ===  $identifiantUtilisateur && password_verify($this->motDePasse, $mdpUtilisateur)) {

                $resultat = new Utilisateur(
                    $utilisateur['ID'],
                    'null',
                    $utilisateur['NOM'],
                    $utilisateur['PRENOM'],
                    $utilisateur['MEL'],
                    $this->motDePasse,
                    $utilisateur['DATE_CONNEXION'],
                    $utilisateur['DATE_INSCRIPTION']);

            }
        }

        return $resultat;

    }
}