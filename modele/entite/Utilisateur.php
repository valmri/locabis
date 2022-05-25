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

    /**
     * Lecture de l'identifiant d'un utilisateur
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Lecture du nom d'un utilisateur
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Lecture du prénom d'un utilisateur
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Lecture de l'adresse-mél d'un utilisateur
     * @return string
     */
    public function getMel(): string
    {
        return $this->mel;
    }

    /**
     * Lecture du mot de passe d'un utilisateur
     * @return string
     */
    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    /**
     * Lecture de la date de connection d'un utilisateur
     * @return string
     */
    public function getDateConnexion(): string
    {
        return $this->date_connexion;
    }

    /**
     * Lecture de la date d'inscription d'un utilisateur
     * @return string
     */
    public function getDateInscription(): string
    {
        return $this->date_inscription;
    }

    /**
     * Écriture de la date de connexion d'un utilisateur
     * @param string $date_connexion
     */
    public function setDateConnexion(string $date_connexion)
    {
        $this->date_connexion = $date_connexion;
    }

    /**
     * Écriture de la date d'inscription d'un utilisateur
     * @param string $date_inscription
     */
    public function setDateInscription(string $date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    /**
     * Écriture de l'adresse-mél d'un utilisateur
     * @param string $mel
     */
    public function setMel(string $mel)
    {
        $this->mel = $mel;
    }

    /**
     * Écriture du mot de passe d'un utilisateur
     * @param string $motDePasse
     */
    public function setMotDePasse(string $motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * Écriture du nom d'un utilisateur
     * @param string $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * Écriture du prénom d'un utilisateur
     * @param string $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Lecture de l'identifiant d'un role
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Écriture de l'identifiant du role d'un utilisateur
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->role = $role;
    }

    /**
     * Écriture de l'identifiant d'un utilisateur
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

}