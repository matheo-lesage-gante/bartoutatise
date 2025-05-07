<?php
//fermeture de la session
session_start();

session_unset(); //détruire les variables de sessions
session_destroy(); 
header("Location: main.php");
?>