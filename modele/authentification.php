<?php

function connexion(string $identifiant, string $motDePasse) {

    $resultat = false;
    $infosUtilisateur = requete("http://172.24.2.143:8055/items/utilisateur?fields=id,mel,motDePasse&[filter][mel][_eq]=".$identifiant);

    if(!empty($infosUtilisateur->data)) {

        $identifiantUtilisateur = $infosUtilisateur->data[0]->mel;
        $mdpUtilisateur = $infosUtilisateur->data[0]->motDePasse;

        if ($identifiant ===  $identifiantUtilisateur && password_verify($motDePasse, $mdpUtilisateur)) {

            $resultat = array(
                "connecte" => true,
                "id" => $infosUtilisateur->data[0]->id,
            );
    
        }

    }

    return $resultat;

}

function estConnecte() {

    $resultat = false;

    if (
        isset($_SESSION['identifiant']) &&
        isset($_SESSION['motDePasse']) &&
        isset($_SESSION['jeton'])
    ) {

        $identifiant = $_SESSION['identifiant'];
        $motDePasse = $_SESSION['motDePasse'];
    
        $infosUtilisateur = requete("http://172.24.2.143:8055/items/utilisateur?fields=mel,motDePasse&[filter][mel][_eq]=".$identifiant);

        if(!empty($infosUtilisateur->data)) {

            $identifiantUtilisateur = $infosUtilisateur->data[0]->mel;
            $mdpUtilisateur = $infosUtilisateur->data[0]->motDePasse;

            if ($identifiant ===  $identifiantUtilisateur && password_verify($motDePasse, $mdpUtilisateur)) {

                $resultat = true;
        
            }
        }

    }

    return $resultat;

}

function getInfosUtilisateur(string $identifiant) {

    $resultat = false;
    
    $infosUtilisateur = requete("http://172.24.2.143:8055/items/utilisateur?fields=mel,prenom,nom,derniere_connexion&[filter][mel][_eq]=".$identifiant);

    if(!empty($infosUtilisateur->data)) {

        $resultat = $infosUtilisateur->data[0];

    }

    return $resultat;

}