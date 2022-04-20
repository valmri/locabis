<?php

class Proprietaire extends Utilisateur
{
    private $telephone;
    private $adresse;
    private $ville;

    public function __construct(int $id, string $photo, string $nom, string $prenom, string $mel, string $motDePasse, string $derniere_connexion, string $date_inscription, string $adresse, string $ville)
    {
        parent::__construct($id, $photo, $nom, $prenom, $mel, $motDePasse, $derniere_connexion, $date_inscription);

        $this->adresse = $adresse;
        $this->ville = $ville;

    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getVille(): string
    {
        return $this->ville;
    }


}