<?php

class Equipement
{
    private $id;
    private $icone;
    private $libelle;
    private $quantite;

    public function __construct(int $id, string $icone,string $libelle, int $quantite) {

        $this->id = $id;
        $this->icone = $icone;
        $this->libelle = $libelle;
        $this->quantite = $quantite;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIcone(): string
    {
        return $this->icone;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

}