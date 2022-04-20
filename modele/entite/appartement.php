<?php

class Appartement
{
    private $id;
    private $titre;
    private $description;
    private $numero;
    private $etage;

    public function __construct(int $id, string $titre, string $description, string $numero, int $etage) {

        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->numero = $numero;
        $this->etage = $etage;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getEtage(): int
    {
        return $this->etage;
    }

}