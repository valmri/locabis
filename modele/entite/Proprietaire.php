<?php

namespace modele\entite;

class Proprietaire
{
    /**
     * @var int $id Identifiant de l'utilisateur
     */
    private $id;

    /**
     * @var string $telephone Numéro de téléphone d'un propriétaire
     */
    private $telephone;

    /**
     * @var string $adresse Adresse d'un propriétaire
     */
    private $adresse;

    /**
     * @var string $ville Ville d'un propriétaire
     */
    private $ville;

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
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
    public function getId(): int
    {
        return $this->id;
    }

}