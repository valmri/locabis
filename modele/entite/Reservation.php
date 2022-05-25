<?php

namespace modele\entite;

class Reservation
{
    /**
     * @var int $id Identifiant d'une réservation
     */
    private $id;

    /**
     * @var string $date_debut Date de début d'une réservation
     */
    private $date_debut;

    /**
     * @var string $date_fin Date de fin d'une réservation
     */
    private $date_fin;

    /**
     * @var int $duree Durée de la réservation
     */
    private $duree;

    /**
     * @var int $utilisateur Identifiant de l'utilisateur
     */
    private $utilisateur;

    /**
     * @var int $appartement Identifiant de l'appartement
     */
    private $appartement;

    /**
     * @var int $etat Identifiant de l'état de la réservation
     */
    private $etat;

    public function __construct() {

    }

    /**
     * Lecture de l'identifiant d'une réservation
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture de la date de début d'une réservation
     * @return string
     */
    public function getDateDebut(): string
    {
        return $this->date_debut;
    }

    /**
     * Lecture de la date de fin d'une réservation
     * @return string
     */
    public function getDateFin(): string
    {
        return $this->date_fin;
    }

    /**
     * Lecture de la durée d'une réservation
     * @return int
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    /**
     * Lecture de l'identifiant d'un utilisateur
     * @return int
     */
    public function getUtilisateur(): int
    {
        return $this->utilisateur;
    }

    /**
     * Lecture de l'identifiant de l'appartement d'une réservation
     * @return int
     */
    public function getAppartement()
    {
        return $this->appartement;
    }

    /**
     * Lecture de l'identifiant de l'état d'une réservation
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Écriture de la date de début d'une réservation
     * @param string $date_debut
     */
    public function setDateDebut(string $date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * Écriture de la date de fin d'une réservation
     * @param string $date_fin
     */
    public function setDateFin(string $date_fin)
    {
        $this->date_fin = $date_fin;
    }

    /**
     * Écriture de l'identifiant de l'utilisateur d'une réservation
     * @param int $utilisateur
     */
    public function setUtilisateur(int $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * Écriture de l'identifiant de l'appartement d'une réservation
     * @param int $appartement
     */
    public function setAppartement(int $appartement)
    {
        $this->appartement = $appartement;
    }

    /**
     * Écriture de l'identifiant de l'état d'une réservation
     * @param int $etat
     */
    public function setEtat(int $etat)
    {
        $this->etat = $etat;
    }

}