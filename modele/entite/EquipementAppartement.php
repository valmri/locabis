<?php
/**
 * EquipementAppartement.php
 * Description : Entite représentant un équipement lié à un appartement ainsi que sa quantité
 * @author : Valentin Marmié
 */
namespace modele\entite;

class EquipementAppartement
{
    /**
     * @var int $id_appartement Identifiant de l'appart
     */
    private $id_appartement;

    /**
     * @var int $id_equipement Identifiant de l'équipement
     */
    private $id_equipement;

    /**
     * @var int $quantite Quantité d'équipement dans un appart
     */
    private $quantite;

    public function __construct() {

    }

    /**
     * Lecture d'un identifiant d'un appartement
     * @return int
     */
    public function getIdAppartement(): int
    {
        return $this->id_appartement;
    }

    /**
     * Lecture de l'identifiant d'un équipement
     * @return int
     */
    public function getIdEquipement(): int
    {
        return $this->id_equipement;
    }

    /**
     * Lecture d'une quantité d'équipement d'un appartement
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * Écriture d'une quantité d'équipement d'un appartement
     * @param int $quantite
     */
    public function setQuantite(int $quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * Écriture d'un identifiant d'un appartement
     * @param int $id_appartement
     */
    public function setIdAppartement(int $id_appartement)
    {
        $this->id_appartement = $id_appartement;
    }

    /**
     * Écriture d'un identifiant d'un équipement
     * @param int $id_equipement
     */
    public function setIdEquipement(int $id_equipement)
    {
        $this->id_equipement = $id_equipement;
    }

}