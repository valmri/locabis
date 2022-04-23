<?php

namespace modele\entite;

class TypeAppart
{
    /**
     * @var int Identifiant d'un type d'appart
     */
    private $id;

    /**
     * @var string Libellé d'un type d'appart
     */
    private $libetype;

    /**
     * @var string Tarif d'une location
     */
    private $tariflocabase;

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
    public function getLibetype(): string
    {
        return $this->libetype;
    }

    /**
     * @return string
     */
    public function getTariflocabase(): string
    {
        return $this->tariflocabase;
    }

    /**
     * @param string $libetype
     */
    public function setLibetype(string $libetype)
    {
        $this->libetype = $libetype;
    }

    /**
     * @param string $tariflocabase
     */
    public function setTariflocabase(string $tariflocabase)
    {
        $this->tariflocabase = $tariflocabase;
    }

}