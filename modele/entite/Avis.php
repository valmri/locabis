<?php

namespace modele\entite;

class Avis
{
    /**
     * @var int $note Note de l'appartement
     */
    private $note;

    /**
     * @var string $commentaire Commentaire de l'appartement
     */
    private $commentaire;

    /**
     * @var string $date_publication Date de publication de l'avis
     */
    private $date_publication;

    /**
     * @var int $reservation Identifiant de la réservation
     */
    private $reservation;

    public function __construct() {

    }

    /**
     * Lecture de la note
     * @return int
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * Lecture du commentaire
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    /**
     * Lecture de la date de publication
     * @return string
     */
    public function getDatePublication(): string
    {
        return $this->date_publication;
    }

    /**
     * Lecture de l'identifiant de la réservation
     * @return int
     */
    public function getReservation(): int
    {
        return $this->reservation;
    }

    /**
     * Écriture de l'identifiant de la réservation
     * @param int $reservation
     */
    public function setReservation(int $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Écriture de la note d'un avis pour un appartement
     * @param int $note
     */
    public function setNote(int $note)
    {
        $this->note = $note;
    }

    /**
     * Écriture du commentaire d'un avis pour un appartement
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * Écriture de la date de publication d'un avis
     * @param string $date_publication
     */
    public function setDatePublication(string $date_publication)
    {
        $this->date_publication = $date_publication;
    }

}