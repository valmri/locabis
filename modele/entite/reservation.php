<?php

class Reservation
{
    private $id;
    private $date_debut;
    private $date_fin;
    private $appartement;

    public function __construct(int $id, string $date_debut, string $date_fin, Appartement $unAppart) {

        $this->id = $id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->appartement = $unAppart;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateDebut(): string
    {
        return $this->date_debut;
    }

    public function getDateFin(): string
    {
        return $this->date_fin;
    }

    public function getAppartement(): Appartement
    {
        return $this->appartement;
    }

}