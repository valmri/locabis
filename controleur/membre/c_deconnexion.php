<?php
/**
 * c_deconnexion.php
 * Description : Permet de déconnecter l'utilisateur
 * @author : Valentin Marmié
 */
unset($_SESSION['utilisateur']);
unset($_SESSION['jeton']);
session_destroy();
header('Location:?page=accueil');