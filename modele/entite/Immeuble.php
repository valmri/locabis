<?php

namespace modele\entite;

class Immeuble
{
    /**
     * @var int Identifiant d'un immeuble
     */
    private $id;

    /**
     * @var string Adresse d'un immeuble
     */
    private $adresse;

    /**
     * @var string Ville d'un immeuble
     */
    private $ville;

    /**
     * @var int Nombre d'étage d'un immeuble
     */
    private $nbEtage;

    /**
     * @var boolean Présence d'un ascensseur dans l'immeuble
     */
    private $ascensseur;

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
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return int
     */
    public function getNbEtage(): int
    {
        return $this->nbEtage;
    }

    /**
     * @param int $nbEtage
     */
    public function setNbEtage(int $nbEtage)
    {
        $this->nbEtage = $nbEtage;
    }

    /**
     * @return bool
     */
    public function isAscensseur(): bool
    {
        return $this->ascensseur;
    }

    /**
     * @param bool $ascensseur
     */
    public function setAscensseur(bool $ascensseur)
    {
        $this->ascensseur = $ascensseur;
    }


}