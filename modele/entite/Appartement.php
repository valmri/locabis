<?php
/**
 * Appartement.php
 * Description : Entite représentant un appartement
 * @author : Valentin Marmié
 */
namespace modele\entite;

use Ds\Vector;

class Appartement
{
    /**
     * @var int $id Identifiant de l'appartement
     */
    private $id;

    /**
     * @var string $photo Identifiant de la photo de l'appartement sur le serveur
     */
    private $photo;

    /**
     * @var string $titre Titre de l'appartement
     */
    private $titre;

    /**
     * @var string $description Description de l'appartement
     */
    private $description;

    /**
     * @var int $numero Numero de l'appartement
     */
    private $numero;

    /**
     * @var int $etage Numero de l'étage de l'appartement
     */
    private $etage;

    /**
     * @var int $proprietaire Identifiant du propriétaire de l'appartement
     */
    private $proprietaire;

    /**
     * @var int $immeuble Identifiant de l'immeuble de l'appartement
     */
    private $immeuble;

    /**
     * @var string $type Identifiant du type de l'appartement
     */
    private $type;

    public function __construct() {

    }

    /**
     * Lecture de l'identifiant de l'appartement
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture de l'identifiant de la photo
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * Lecture du titre de l'appartement
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Lecture de la description de l'appartement
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Lecture du numéro de l'appartement
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Lecture du numéro de l'étage de l'appartement
     * @return int
     */
    public function getEtage(): int
    {
        return $this->etage;
    }

    /**
     * Lecture de l'identifiant du propriétaire
     * @return int
     */
    public function getProprietaire(): int
    {
        return $this->proprietaire;
    }

    /**
     * Lecture de l'identifiant de l'immeuble
     * @return int
     */
    public function getImmeuble()
    {
        return $this->immeuble;
    }

    /**
     * Lecture de l'identifiant du type de l'appartement
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Écriture de l'identifiant de la photo de l'appartement
     * @param string $photo
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Écriture du titre de l'appartement
     * @param string $titre
     */
    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    /**
     * Écriture de la description de l'appartement
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Écriture du numéro de l'appartement
     * @param int $numero
     */
    public function setNumero(int $numero)
    {
        $this->numero = $numero;
    }

    /**
     * Écriture du numéro de l'étage de l'appartement
     * @param int $etage
     */
    public function setEtage(int $etage)
    {
        $this->etage = $etage;
    }

    /**
     * Écriture de l'identifiant du propriétaire de l'appartement
     * @param int $proprietaire
     */
    public function setProprietaire(int $proprietaire)
    {
        $this->proprietaire = $proprietaire;
    }

    /**
     * Écriture de l'identifiant de l'immeuble de l'appartement
     * @param int $immeuble
     */
    public function setImmeuble(int $immeuble)
    {
        $this->immeuble = $immeuble;
    }

    /**
     * Écriture de l'identifiant du type de l'appartement
     * @param int $type
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

}