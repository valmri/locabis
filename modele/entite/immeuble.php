<?php

class Immeuble
{
    private $id;
    private $adresse;
    private $ville;
    private $nbEtage;
    private $ascensseur;

    public function __construct(int $id, string $adresse, string $ville, int $nbEtage, boolean $ascensseur) {

        $this->id = $id;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->nbEtage =$nbEtage;
        $this->ascensseur = $ascensseur;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getNbEtage(): int
    {
        return $this->nbEtage;
    }

    public function getAscensseur(): boolean{
        return $this->ascensseur;
    }
}