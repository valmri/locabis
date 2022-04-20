<?php

class DAO {

    private $serveur;
    private $bd;
    private $identifiant;
    private $mdp;
    private $pdo;

    public function __construct() {

        $this->serveur = '';
        $this->bd = '';
        $this->identifiant = '';
        $this->mdp = '';

    }

    public function getPDO() {

        if($this->pdo === null) {

            $connexion = new PDO('mysql:host='. $this->serveur .';dbname='. $this->bd, $this->identifiant, $this->mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $connexion;

        }

        return $this->pdo;
    }

}