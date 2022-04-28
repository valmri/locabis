<?php

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
     * @return int
     */
    public function getIdAppartement(): int
    {
        return $this->id_appartement;
    }

    /**
     * @return int
     */
    public function getIdEquipement(): int
    {
        return $this->id_equipement;
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

    /**
     * @param int $id_appartement
     */
    public function setIdAppartement(int $id_appartement)
    {
        $this->id_appartement = $id_appartement;
    }

    /**
     * @param int $id_equipement
     */
    public function setIdEquipement(int $id_equipement)
    {
        $this->id_equipement = $id_equipement;
    }

}