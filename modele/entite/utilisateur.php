<?php

class Utilisateur
{
    private $id;
    private $photo;
    private $nom;
    private $prenom;
    private $mel;
    private $motDePasse;
    private $derniere_connexion;
    private $date_inscription;

    public function __construct(
        int $id,
        string $photo,
        string $nom,
        string $prenom,
        string $mel,
        string $motDePasse,
        string $derniere_connexion,
        string $date_inscription
    ) {

        $this->id = $id;
        $this->photo = $photo;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mel = $mel;
        $this->motDePasse = $motDePasse;
        $this->derniere_connexion = $derniere_connexion;
        $this->date_inscription = $date_inscription;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getMel(): string
    {
        return $this->mel;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getDerniereConnexion(): string
    {
        return $this->derniere_connexion;
    }

    public function getDateInscription(): string
    {
        return $this->date_inscription;
    }



}