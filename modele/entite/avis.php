<?php

class Avis
{
    private $note;
    private $commentaire;
    private $date_publication;

    public function __construct(int $note, string $commentaire, string $date_publication) {

        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->date_publication = $date_publication;

    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    public function getDatePublication(): string
    {
        return $this->date_publication;
    }
}