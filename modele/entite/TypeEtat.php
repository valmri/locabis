<?php

namespace modele\entite;

class TypeEtat
{
    /**
     * @var int $id Identifiant d'un état de réservation
     */
    private $id;

    /**
     * @var string $icone Icone d'un état de réservation
     */
    private $icone;

    /**
     * @var string Libelle d'un état de réservation
     */
    private $libelle;

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
    public function getIcone(): string
    {
        return $this->icone;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $icone
     */
    public function setIcone(string $icone)
    {
        $this->icone = $icone;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

}