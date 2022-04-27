<?php
namespace modele\entite;

class Utilisateur
{
    /**
     * @var int $id identifiant de l'utilisateur
     */
    private $id;

    /**
     * @var string $nom nom de l'utilisateur
     */
    private $nom;

    /**
     * @var string $prenom prenom de l'utilisateur
     */
    private $prenom;

    /**
     * @var string $mel adresse mel de l'utilisateur
     */
    private $mel;

    /**
     * @var string $motDePasse mot de passe de l'utilisateur
     */
    private $motDePasse;

    /**
     * @var string $derniere_connexion date de derniere connexion de l'utilisateur
     */
    private $date_connexion;

    /**
     * @var string $date_inscription date d'inscription de l'utilisateur
     */
    private $date_inscription;

    /**
     * @var int $role Identifiant du rôle de l'utilisateur
     */
    private $role;

    public function __construct() {

    }

    /* Liste des accesseurs */

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
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getMel(): string
    {
        return $this->mel;
    }

    /**
     * @return string
     */
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    /**
     * @return string
     */
    public function getDateConnexion(): string
    {
        return $this->date_connexion;
    }

    /**
     * @return string
     */
    public function getDateInscription(): string
    {
        return $this->date_inscription;
    }

    /* Liste des mutateurs */

    /**
     * @param string $date_connexion
     */
    public function setDateConnexion(string $date_connexion)
    {
        $this->date_connexion = $date_connexion;
    }

    /**
     * @param string $date_inscription
     */
    public function setDateInscription(string $date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    /**
     * @param string $mel
     */
    public function setMel(string $mel)
    {
        $this->mel = $mel;
    }

    /**
     * @param string $motDePasse
     */
    public function setMotDePasse(string $motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->role = $role;
    }

}