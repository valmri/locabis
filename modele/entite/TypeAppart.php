<?php
/**
 * TypeAppart.php
 * Description : Entite représentant un type d'appartement
 * @author : Valentin Marmié
 */
namespace modele\entite;

class TypeAppart
{
    /**
     * @var int $id Identifiant d'un type d'appart
     */
    private $id;

    /**
     * @var string $libetype Libellé d'un type d'appart
     */
    private $libetype;

    /**
     * @var string $tariflocabase Tarif d'un type d'appart
     */
    private $tariflocabase;

    public function __construct() {

    }

    /**
     * Lecture de l'identifiant d'un type d'appart
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Lecture du libelle d'un type d'appart
     * @return string
     */
    public function getLibetype(): string
    {
        return $this->libetype;
    }

    /**
     * Lecture du tarif d'un type d'appart
     * @return string
     */
    public function getTariflocabase(): string
    {
        return $this->tariflocabase;
    }

    /**
     * Écriture du libelle d'un type d'appart
     * @param string $libetype
     */
    public function setLibetype(string $libetype)
    {
        $this->libetype = $libetype;
    }

    /**
     * Écriture du tarif d'un type d'appart
     * @param string $tariflocabase
     */
    public function setTariflocabase(string $tariflocabase)
    {
        $this->tariflocabase = $tariflocabase;
    }

}