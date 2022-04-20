<?php
unset($_SESSION['utilisateur']);
unset($_SESSION['jeton']);
header('Location:?page=accueil');