<?php

namespace modele\entite;

class Avis
{
    /**
     * @var int $note Note pour un appartement
     */
    private $note;

    /**
     * @var string Commentaire pour un appart
     */
    private $commentaire;

    /**
     * @var string Date de publication
     */
    private $date_publication;

    /**
     * @var int Identifiant d'une réservation
     */
    private $reservation;

    /**
     * @var int Identifiant d'un appart
     */
    private $appartement;

    /**
     * @var Mixed Utilisateur ayant publié l'avis
     */
    private $utilisateur;

    public function __construct() {

    }

    /**
     * @return int
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * @return string
     */
    public function getDatePublication(): string
    {
        return $this->date_publication;
    }

    /**
     * @return int
     */
    public function getReservation(): int
    {
        return $this->reservation;
    }

    /**
     * @param int $reservation
     */
    public function setReservation(int $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * @return int
     */
    public function getAppartement(): int
    {
        return $this->appartement;
    }

    /**
     * @param int $appartement
     */
    public function setAppartement(int $appartement)
    {
        $this->appartement = $appartement;
    }

    /**
     * @param int $note
     */
    public function setNote(int $note)
    {
        $this->note = $note;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @param string $date_publication
     */
    public function setDatePublication(string $date_publication)
    {
        $this->date_publication = $date_publication;
    }

    /**
     * @return Mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param Mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

}