<?php
/**
 * TypeEtat.php
 * Description : Entite représentant un type d'état d'une réservation
 * @author : Valentin Marmié
 */
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
     * Lecture de l'identifiant d'un type d'état
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture de l'icône d'un type d'état
     * @return string
     */
    public function getIcone(): string
    {
        return $this->icone;
    }

    /**
     * Lecture du libelle d'un type d'état
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * Écriture de l'icone d'un type d'état
     * @param string $icone
     */
    public function setIcone(string $icone)
    {
        $this->icone = $icone;
    }

    /**
     * Écriture du libelle d'un type d'état
     * @param string $libelle
     */
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

}