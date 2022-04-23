<?php
unset($_SESSION['utilisateur']);
unset($_SESSION['jeton']);
session_destroy();
header('Location:?page=accueil');