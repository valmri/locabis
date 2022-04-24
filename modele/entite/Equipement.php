<?php

namespace modele\entite;

class Equipement
{
    /**
     * @var int $id Identifiant d'un équipement
     */
    private $id;

    /**
     * @var string $icone Icone d'un équipement
     */
    private $icone;

    /**
     * @var string $libelle Libelle d'un équipement
     */
    private $libelle;

    /**
     * @var int $quantite Quantité d'équipement
     */
    private $quantite;

    public function __construct() {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIcone(): string
    {
        return $this->icone;
    }

    /**
     * @param string $icone
     */
    public function setIcone(string $icone)
    {
        $this->icone = $icone;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite)
    {
        $this->quantite = $quantite;
    }

}