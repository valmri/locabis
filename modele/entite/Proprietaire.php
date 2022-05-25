<?php

namespace modele\entite;

class Proprietaire
{
    /**
     * @var int $id Identifiant d'un propriétaire
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
     * Lecture du numéro de téléphone d'un propriétaire
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * Écriture du numéro de téléphone d'un propriétaire
     * @param string $telephone
     */
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Lecture de l'adresse d'un propriétaire
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Écriture de l'adresse d'un propriétaire
     * @param string $adresse
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * Lecture de la ville d'un propriétaire
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * Écriture de la ville d'un propriétaire
     * @param string $ville
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;
    }

    /**
     * Lecture de l'identifiant d'un propriétaire
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}