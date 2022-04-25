<?php

namespace modele\entite;

use Ds\Vector;

class Appartement
{
    /**
     * @var int Identifiant de l'appartement
     */
    private $id;

    /**
     * @var string Identifiant de la photo de l'appartement sur le serveur
     */
    private $photo;

    /**
     * @var string Titre de l'appartement
     */
    private $titre;

    /**
     * @var string Description de l'appartement
     */
    private $description;

    /**
     * @var int Numero de l'appartement
     */
    private $numero;

    /**
     * @var int Numero de l'étage de l'appartement
     */
    private $etage;

    /**
     * @var int Identifiant du propriétaire de l'appartement
     */
    private $proprietaire;

    /**
     * @var mixed Identifiant de l'immeuble de l'appartement
     */
    private $immeuble;

    /**
     * @var mixed Identifiant du type de l'appartement
     */
    private $type;

    /**
     * @var Vector Collection d'équipements
     */
    private $equipements;

    /**
     * @var Vector Collection d'avis
     */
    private $avis;

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
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @return int
     */
    public function getEtage(): int
    {
        return $this->etage;
    }

    /**
     * @return int
     */
    public function getProprietaire(): int
    {
        return $this->proprietaire;
    }

    /**
     * @return mixed
     */
    public function getImmeuble()
    {
        return $this->immeuble;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero)
    {
        $this->numero = $numero;
    }

    /**
     * @param int $etage
     */
    public function setEtage(int $etage)
    {
        $this->etage = $etage;
    }

    /**
     * @param int $proprietaire
     */
    public function setProprietaire(int $proprietaire)
    {
        $this->proprietaire = $proprietaire;
    }

    /**
     * @param mixed $immeuble
     */
    public function setImmeuble($immeuble)
    {
        $this->immeuble = $immeuble;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Vector
     */
    public function getEquipements(): Vector
    {
        return $this->equipements;
    }

    /**
     * @param Vector $equipements
     */
    public function setEquipements(Vector $equipements)
    {
        $this->equipements = $equipements;
    }

    /**
     * @return Vector
     */
    public function getAvis(): Vector
    {
        return $this->avis;
    }

    /**
     * @param Vector $avis
     */
    public function setAvis(Vector $avis)
    {
        $this->avis = $avis;
    }

}