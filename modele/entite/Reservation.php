<?php

namespace modele\entite;

class Reservation
{
    /**
     * @var int Identifiant d'une réservation
     */
    private $id;

    /**
     * @var string Date de début d'une réservation
     */
    private $date_debut;

    /**
     * @var string Date de fin d'une réservation
     */
    private $date_fin;

    /**
     * @var int Durée de la réservation
     */
    private $duree;

    /**
     * @var int Identifiant de l'utilisateur
     */
    private $utilisateur;

    /**
     * @var mixed Identifiant de l'appartement
     */
    private $appartement;

    /**
     * @var mixed Identifiant de l'état de la réservation
     */
    private $etat;

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
    public function getDateDebut(): string
    {
        return $this->date_debut;
    }

    /**
     * @return string
     */
    public function getDateFin(): string
    {
        return $this->date_fin;
    }

    /**
     * @return int
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    /**
     * @return int
     */
    public function getUtilisateur(): int
    {
        return $this->utilisateur;
    }

    /**
     * @return mixed
     */
    public function getAppartement()
    {
        return $this->appartement;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $date_debut
     */
    public function setDateDebut(string $date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @param string $date_fin
     */
    public function setDateFin(string $date_fin)
    {
        $this->date_fin = $date_fin;
    }

    /**
     * @param int $utilisateur
     */
    public function setUtilisateur(int $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * @param mixed $appartement
     */
    public function setAppartement($appartement)
    {
        $this->appartement = $appartement;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

}