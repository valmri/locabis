<?php

class typeAppart
{
    private $id;
    private $libetype;
    private $tariflocabase;

    public function __construct(int $id, string $libetype,string $tariflocabase) {

        $this->id = $id;
        $this->libetype = $libetype;
        $this->tariflocabase = $tariflocabase;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibetype(): string
    {
        return $this->libetype;
    }

    public function getTariflocabase(): string
    {
        return $this->tariflocabase;
    }

}