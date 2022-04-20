<?php

class Reservation
{
    private $id;
    private $date_debut;
    private $date_fin;

    public function __construct(int $id, string $date_debut, string $date_fin) {

        $this->id = $id;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;

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
}