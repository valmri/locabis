<?php
/**
 * Immeuble.php
 * Description : Entite représentant un immeuble
 * @author : Valentin Marmié
 */
namespace modele\entite;

class Immeuble
{
    /**
     * @var int $id Identifiant d'un immeuble
     */
    private $id;

    /**
     * @var string $adresse Adresse d'un immeuble
     */
    private $adresse;

    /**
     * @var string $ville Ville d'un immeuble
     */
    private $ville;

    /**
     * @var int $nbetage Nombre d'étage d'un immeuble
     */
    private $nbetage;

    /**
     * @var boolean $ascenseur Présence d'un ascensseur dans l'immeuble
     */
    private $ascenseur;

    public function __construct() {

    }

    /**
     * Lecture de l'identifiant d'un avis
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture d'une adresse d'un immeuble
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Écriture d'une adresse d'un immeuble
     * @param string $adresse
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * Lecture d'une ville d'un immeuble
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * Écriture d'une ville d'un immeuble
     * @param string $ville
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;
    }

    /**
     * Lecture du nombre d'étage d'un immeuble
     * @return int
     */
    public function getNbetage(): int
    {
        return $this->nbetage;
    }

    /**
     * Écriture d'un nombre d'étages d'un immeuble
     * @param int $nbetage
     */
    public function setNbetage(int $nbetage)
    {
        $this->nbetage = $nbetage;
    }

    /**
     * Lecture de la présence d'un ascenseur dans un immeuble
     * @return bool
     */
    public function isAscenseur(): bool
    {
        return $this->ascenseur;
    }

    /**
     * Écriture du booléen définissant l'ascenseur dans un immeuble
     * @param bool $ascenseur
     */
    public function setAscenseur(bool $ascenseur)
    {
        $this->ascenseur = $ascenseur;
    }


}