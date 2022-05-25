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

    public function __construct() {

    }

    /**
     * Lecture de l'identifiant d'un équipement
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture de l'icône d'un équipement
     * @return string
     */
    public function getIcone(): string
    {
        return $this->icone;
    }

    /**
     * Écriture de l'icône d'un équipement
     * @param string $icone
     */
    public function setIcone(string $icone)
    {
        $this->icone = $icone;
    }

    /**
     * Lecture du libelle d'un équipement
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * Écriture du libelle d'un équipement
     * @param string $libelle
     */
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

}